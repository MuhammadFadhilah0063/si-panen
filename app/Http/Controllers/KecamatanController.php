<?php

namespace App\Http\Controllers;

use App\DataTables\KecamatanDataTable;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KecamatanDataTable $table)
    {
        return $table->render('templates.datatable', [
            'title' => 'Kecamatan',
            'buttons' => "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#tambahKecamatan'><i class='fas fa-sm fa-plus mr-2'></i> Tambah Kecamatan</button>"
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
        $kec = new Kecamatan();

        $kec->nama = $request->nama;

        $kec->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan kecamatan baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $kecamatan->nama = $request->nama;

        $kecamatan->save();

        return redirect()->back()->with('success', 'Berhasil mengubah kecamatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus kecamatan');
    }

    public function getKelurahanByKecamatan($id)
    {
        $kelurahan = Kecamatan::where('id', $id)->first()->kelurahan;
        return response()->json($kelurahan);
    }

    public function getKecamatan($id)
    {
        $kecamatan = Kecamatan::where('id', $id)->first();
        return response()->json($kecamatan);
    }
}
