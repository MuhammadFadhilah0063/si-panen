<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kecamatan;
use App\Models\HasilPanen;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class AuthController extends Controller
{
    public function dashboardGuest()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->get();

        return view('dashboard', [
            'title' => 'Dashboard',
            'beritas' => $beritas
        ]);
    }

    public function dashboardAdmin()
    {

        // Menghitung masing-masing hasil panen kecamatan
        $hasilProduksi = HasilPanen::join('kecamatan', 'hasil_panens.kecamatan_id', '=', 'kecamatan.id')
        ->select('kecamatan.nama as kecamatan', DB::raw('SUM(hasil_panens.hasil_produksi) as total_produksi'))
        ->groupBy('kecamatan.nama')
        ->get();

        // Menghitung Nilai Tertinggi
        $produksiTertinggi = HasilPanen::with(['kecamatan'])->select('kecamatan_id', DB::raw('SUM(hasil_produksi) as total_produksi'))
        ->groupBy('kecamatan_id')
        ->orderBy('total_produksi', 'desc')
        ->first();

        // Menghitung Nilai Terendah
        $produksiTerendah = HasilPanen::with(['kecamatan'])->select('kecamatan_id', DB::raw('SUM(hasil_produksi) as total_produksi'))
        ->groupBy('kecamatan_id')
        ->orderBy('total_produksi', 'asc')
            ->first();

        // Menghitung total hasil produksi
        $totalProduksi = HasilPanen::sum('hasil_produksi');

        return view('auth.dashboard', [
            'title' => 'Dashboard',
            'data'  => $hasilProduksi,
            'produksiTerendah' => $produksiTerendah,
            'produksiTertinggi' => $produksiTertinggi,
            'totalProduksi' => $totalProduksi,
        ]);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function tambahpetani(){
        return view('auth.tambahpetani', [
            'title' => 'Tambah Petani',
            'kecamatan' => \App\Models\Kecamatan::all(),
            'penyuluh' => \App\Models\Penyuluh::all(),
            'kelompok' => \App\Models\Kelompok::all(),
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|min:3',
            'password' => 'required|min:3'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } else  if($user->hasRole('penyuluh')) {
                return redirect()->route('penyuluh.dashboard');
            } else  if ($user->hasRole('petani')) {
                return redirect()->route('petani.dashboard');
            } else  if ($user->hasRole('kabid')) {
                return redirect()->route('kabid.dashboard');
            }
            
        }

        return back()->withErrors(['username' => 'Username Salah', 'password' => 'Password Salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function profile()
    {
        return view('profile', [
            'title' => 'Profile'
        ]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $request->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:3|unique:users,username,' . $user->id . ',id',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'telp' => 'required|min:3',
            'password' => 'nullable|min:3'
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->telp = $request->telp;

        if ($request->password != null && $request->password2 != null) {
            if ($request->password != $request->password2) {
                return back()->withErrors(['password' => 'Password tidak sama']);
            } else {
                $user->password = bcrypt($request->password);
            }
        }

        if ($request->foto) {
            $file = $request->file('foto');
            $photo = Image::make($file->getPathname());
            $path = 'img/profile/' . time() . "_" . $file->getClientOriginalName();
            $photoUrl = $photo->save(public_path($path), 50);
            $user->foto = $path;
        }

        $user->save();

        return back()->with('success', 'Profile berhasil diupdate');
    }

    public function profil()
    {
        return view('profil', [
            'title' => 'Profil',
        ]);
    }
}