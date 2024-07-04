<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\Gapoktan;
use App\Models\Pegawai;
use App\Models\Penyuluh;
use App\Models\Poktan;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $table)
    {
        return $table->render('templates.datatable', [
            'title' => 'User Config',
            'buttons' => '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahUserModal"><i class="fas fa-sm fa-plus mr-2"></i> Tambah User</button>',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $user = new User();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'roles' => 'required|string|max:255',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->telp = $request->telp;
        $user->assignRole($request->roles);
        $user->status = "Aktif";

        if ($request->password && $request->password_2) {
            if ($request->password != $request->password_2) {
                return back()->withErrors(['password' => 'Password tidak sama']);
            } else {
                $user->password = bcrypt($request->password);
            }
        }

        $user->save();

        return redirect()->route('admin.user-config.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('roles')->where('id', $id)->firstOrFail();
        $roles = $user->roles->pluck('name')->implode(', ');

        return view('auth.user.show', [
            'title' => 'User Detail',
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('roles')->where('id', $id)->firstOrFail();
        $user_roles = $user->roles->pluck('name')->implode(', ');
        return view('auth.user.edit', [
            'title' => 'User Edit',
            'user' => $user,
            'roles' => $user_roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'telp' => 'required|string|max:255',
            'roles' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->telp = $request->telp;
        $user->status = $request->status;

        if($request->password && $request->password_2) {
            if($request->password != $request->password_2) {
                return back()->withErrors(['password' => 'Password tidak sama']);
            } else {
                $user->password = bcrypt($request->password);
            }
        }

        $user->save();
        $user->syncRoles($request->roles);

        return redirect()->route('admin.user-config.edit', $user->id)->with('success', 'User berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        try {
            // Hapus pengguna
            $user->roles()->detach();
            $user->delete();

            return redirect()->back()->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            // Tangani pengecualian
            return redirect()->back()->with('error', 'User gagal dihapus: ' . $e->getMessage());
        }
    }

    public function getUsersByAkun(Request $request)
    {
        $tipeAkun = $request->akun;
        $users = [];

        if ($tipeAkun == "penyuluh" ) {
            $users = Penyuluh::all();
        } else if ($tipeAkun == "pegawai") {
            $users = Pegawai::all();
        } else if ($tipeAkun == "kabid") {
            $users = Pegawai::whereHas('jabatan', function ($query) {
                $query->where('nama_jabatan', 'kepala bidang');
            })->get();
        } else if ($tipeAkun == "petani") {
            $usersPoktan = Poktan::all();
            $usersGapoktan = Gapoktan::all();
            $users = $usersPoktan->concat($usersGapoktan);
        }

        return response()->json($users);
    }
}
