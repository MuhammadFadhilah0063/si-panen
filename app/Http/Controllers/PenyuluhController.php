<?php

namespace App\Http\Controllers;

use App\DataTables\PenyuluhDataTable;
use App\Models\Penyuluh;
use Illuminate\Http\Request;

class PenyuluhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PenyuluhDataTable $table)
    {
        $buttons = '';
        if(auth()->user()->hasRole('admin')){
            $buttons = "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#tambahPenyuluh'><i class='fas fa-sm fa-plus mr-2'></i> Tambah Penyuluh</button>";
        }
        return $table->render('templates.datatable', [
            'title' => 'Penyuluh',
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
        $penyuluh = new Penyuluh();

        $penyuluh->nama_penyuluh = $request->nama_penyuluh;
        $penyuluh->nip_penyuluh = $request->nip_penyuluh;
        $penyuluh->alamat_penyuluh = $request->alamat_penyuluh;
        $penyuluh->no_hp_penyuluh = $request->no_hp_penyuluh;

        $penyuluh->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan penyuluh baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penyuluh  $penyuluh
     * @return \Illuminate\Http\Response
     */
    public function show(Penyuluh $penyuluh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyuluh  $penyuluh
     * @return \Illuminate\Http\Response
     */
    public function edit(Penyuluh $penyuluh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penyuluh  $penyuluh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penyuluh $penyuluh)
    {
        $penyuluh->nama_penyuluh = $request->nama_penyuluh;
        $penyuluh->nip_penyuluh = $request->nip_penyuluh;
        $penyuluh->alamat_penyuluh = $request->alamat_penyuluh;
        $penyuluh->no_hp_penyuluh = $request->no_hp_penyuluh;

        $penyuluh->save();

        return redirect()->back()->with('success', 'Berhasil mengubah penyuluh');
    }

    public function getPenyuluh(){

        $penyuluh = Penyuluh::all();
        return response()->json($penyuluh);
    }

    public function getPenyuluhById($id){
        $penyuluh = Penyuluh::where('id', $id)->first();
        return response()->json($penyuluh);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyuluh  $penyuluh
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyuluh $penyuluh)
    {
        $penyuluh->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus penyuluh');
    }

    // public function getKelurahanByKecamatan($id)
    // {
    //     $kelurahan = Kecamatan::where('id', $id)->first()->kelurahan;
    //     return response()->json($kelurahan);
    // }

    // public function getKecamatan($id)
    // {
    //     $kecamatan = Kecamatan::where('id', $id)->first();
    //     return response()->json($kecamatan);
    // }
}
