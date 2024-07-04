<?php

namespace App\Http\Controllers;

use App\DataTables\PegawaiDataTable;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PegawaiDataTable $table)
    {
        $buttons = '';
        if(auth()->user()->hasRole('admin')){
            $buttons = "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#tambahPegawai'><i class='fas fa-sm fa-plus mr-2'></i> Tambah Pegawai</button>";
        }
        return $table->render('templates.datatable', [
            'title' => 'Pegawai',
            'buttons' => $buttons
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
            Pegawai::create($data);

            return redirect()->back()->with('success', 'Pegawai berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Pegawai gagal ditambahkan');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pegawai::with('jabatan')->findOrFail($id);
        $jabatan = Jabatan::all();

        return view('admin.pegawai.edit', [
            'title' => 'Edit Pegawai',
            'jabatan' => $jabatan,
            'data' => $data,
            'urlback' => route('admin.pegawai.index'),
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
        $data = Pegawai::findOrFail($id);
        try {
            $data->update($request->all());

            return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Pegawai gagal diubah');
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
        $data = Pegawai::findOrFail($id);

        try {
            $data->delete();

            return redirect()->back()->with('success', 'Pegawai berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Pegawai gagal dihapus');
        }
    }
}
