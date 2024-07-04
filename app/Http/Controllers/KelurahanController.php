<?php

namespace App\Http\Controllers;

use App\DataTables\KelurahanDataTable;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KelurahanDataTable $dataTable)
    {
        return $dataTable->render('templates.datatable', [
            'title' => 'Kelurahan',
            'buttons' => "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#tambahKelurahan'><i class='fas fa-sm fa-plus mr-2'></i> Tambah Kelurahan</button>"
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
        $kel = new Kelurahan();

        $kel->nama = $request->nama;
        $kel->kecamatan_id = $request->kecamatan_id;

        $kel->save();

        return redirect()->back()->with('success', 'Kelurahan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kel = Kelurahan::where('id', $id)->first();
        
        $kel->nama = $request->nama;
        $kel->kecamatan_id = $request->kecamatan_id;

        $kel->save();

        return redirect()->back()->with('success', 'Kelurahan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelurahan $kelurahan)
    {
        $kelurahan->delete();
        return redirect()->back()->with('success', 'Kelurahan berhasil dihapus');
    }

    public function getKelurahan($id)
    {
        $kelurahan = Kelurahan::where('id', $id)->first();

        return response()->json($kelurahan);
    }

    public function getKelurahanByKecamatan($id)
    {
        $kelurahan = Kelurahan::where('kecamatan_id', $id)->get();

        return response()->json($kelurahan);
    }
}