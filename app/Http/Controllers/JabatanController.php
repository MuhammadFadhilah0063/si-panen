<?php

namespace App\Http\Controllers;

use App\DataTables\JabatanDataTable;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JabatanDataTable $table)
    {
        return $table->render('templates.datatable', [
            'title' => 'Jabatan',
            'buttons' => "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#tambahJabatan'><i class='fas fa-sm fa-plus mr-2'></i> Tambah Jabatan</button>"
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
        $data = $request->all();

        try {
            Jabatan::create($data);

            return redirect()->back()->with('success', 'Jabatan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Jabatan gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Jabatan::findOrFail($id);

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Jabatan::with('jabatan')->findOrFail($id);

        return view('admin.Jabatan.edit', [
            'title' => 'Edit Jabatan',
            'data' => $data,
            'urlback' => route('admin.jabatan.index'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Jabatan::findOrFail($id);
        try {
            $data->update($request->all());

            return redirect()->route('admin.jabatan.index')->with('success', 'Jabatan berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'jabatan gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Jabatan::findOrFail($id);

        try {
            $data->delete();

            return redirect()->back()->with('success', 'Jabatan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Jabatan gagal dihapus');
        }
    }
}
