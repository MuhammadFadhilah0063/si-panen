<?php

namespace App\Http\Controllers;

use App\DataTables\PoktanDataTable;
use App\Models\Poktan;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PoktanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PoktanDataTable $table)
    {
        $buttons = '';
        if(auth()->user()->hasRole('admin')){
            $buttons = "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#tambahPoktan'><i class='fas fa-sm fa-plus mr-2'></i>Tambah Poktan</button>";
        }
        return $table->render('templates.datatable', [
            'title' => 'Poktan',
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
        return view('auth.poktan.create', [
            'title' => 'Tambah Poktan',
            'kecamatan' => \App\Models\Kecamatan::all(),
            'penyuluh' => \App\Models\Penyuluh::all(),
            'kelompok' => \App\Models\Kelompok::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $poktan = new Poktan();

        $poktan->nik = $request->NIK;
        $poktan->tgl_lahir = $request->tgl_lahir;
        $poktan->tempat_lahir = $request->tempat_lahir;
        $poktan->nama_petani = $request->nama_petani;
        $poktan->luas_lahan_poktan = $request->luas_lahan_poktan;
        $poktan->no_hp_poktan = $request->no_hp_poktan;
        $poktan->alamat_poktan = $request->alamat_poktan;
        $poktan->penyuluh_id = $request->penyuluh_id;
        $poktan->kecamatan_id = $request->kecamatan_id;
        $poktan->kelurahan_id = $request->kelurahan_id;
        $poktan->status_poktan = $request->status_poktan;

        $poktan->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan Poktan baru');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poktan $poktan)
    {

        $poktan->nama_petani = $request->nama_petani;
        $poktan->luas_lahan_poktan = $request->luas_lahan_poktan;
        $poktan->no_hp_poktan = $request->no_hp_poktan;
        $poktan->alamat_poktan = $request->alamat_poktan;
        $poktan->penyuluh_id = $request->penyuluh_id;
        $poktan->kecamatan_id = $request->kecamatan_id;
        $poktan->kelurahan_id = $request->kelurahan_id;
        $poktan->status_poktan = $request->status_poktan;
        $poktan->nik = $request->NIK;
        $poktan->tgl_lahir = $request->tgl_lahir;
        $poktan->tempat_lahir = $request->tempat_lahir;


        $poktan->save();

        return redirect()->back()->with('success', 'Berhasil mengubah Poktan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poktan $poktan)
    {
        $poktan->delete();
        $kelompok = Kelompok::find($poktan->kelompok_id);
        if ($kelompok) {
            $kelompok->delete();
        }
        return redirect()->back()->with('success', 'Berhasil menghapus Poktan');
    }

    public function getPoktan(){
        $poktan = Poktan::all();
        return response()->json($poktan);
    }

    public function getPoktanById($id){
        $poktan = Poktan::where('id', $id)->first();
        return response()->json($poktan);
    }
}