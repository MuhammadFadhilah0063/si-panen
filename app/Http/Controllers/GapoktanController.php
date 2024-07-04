<?php

namespace App\Http\Controllers;
use App\DataTables\GapoktanDataTable;
use App\Models\Gapoktan;
use App\Models\Kelompok;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GapoktanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GapoktanDataTable $table)
    {
        $buttons = '';

        // Menambahkan kondisi untuk menyembunyikan tombol berdasarkan peran pengguna
        if (auth()->user()->hasRole('admin')) {
            // Jika pengguna adalah admin, tambahkan tombol
            $buttons = "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#tambahGapoktan'><i class='fas fa-sm fa-plus mr-2'></i>Tambah Gapoktan</button>";
        }

        return $table->render('templates.datatable', [
            'title' => 'Gapoktan',
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
        return view('auth.gapoktan.create', [
            'title' => 'Tambah Gapoktan',
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
        // mencreate kelompok dulu
        $kelompok = new Kelompok();
        $kelompok->nama_kelompok = $request->kelompok_nama;
        $kelompok->save();
        // get kelompok id
        $kelompokGet = Kelompok::where('nama_kelompok', $request->kelompok_nama)->first();
        $gapoktan = new Gapoktan();

        $gapoktan->nik = $request->NIK;
        $gapoktan->tgl_lahir = $request->tgl_lahir;
        $gapoktan->tempat_lahir = $request->tempat_lahir;

        $gapoktan->nama_petani = $request->nama_petani;
        $gapoktan->luas_lahan_gapoktan = $request->luas_lahan_gapoktan;
        $gapoktan->no_hp_gapoktan = $request->no_hp_gapoktan;
        $gapoktan->alamat_gapoktan = $request->alamat_gapoktan;
        $gapoktan->status_gapoktan = $request->status_gapoktan;
        $gapoktan->penyuluh_id = $request->penyuluh_id;
        $gapoktan->kelompok_id = $kelompokGet->id;
        $gapoktan->kecamatan_id = $request->kecamatan_id;
        $gapoktan->kelurahan_id = $request->kelurahan_id;

        $gapoktan->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan Gapoktan baru');
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
    public function update(Request $request, Gapoktan $gapoktan)
    {
        $kelompokCek = Kelompok::where('nama_kelompok', $request->kelompok_nama)->first();
        if (!$kelompokCek) {
            $kelompokLama = Kelompok::find($gapoktan->kelompok_id);
            $kelompokLama->delete();
            // mencreate kelompok
            $kelompok = new Kelompok();
            $kelompok->nama_kelompok = $request->kelompok_nama;
            $kelompok->save();
        }

        // get kelompok id
        $kelompokGet = Kelompok::where('nama_kelompok', $request->kelompok_nama)->first();

        $gapoktan->nik = $request->NIK;
        $gapoktan->tgl_lahir = $request->tgl_lahir;
        $gapoktan->tempat_lahir = $request->tempat_lahir;
        $gapoktan->nama_petani = $request->nama_petani;
        $gapoktan->luas_lahan_gapoktan = $request->luas_lahan_gapoktan;
        $gapoktan->no_hp_gapoktan = $request->no_hp_gapoktan;
        $gapoktan->alamat_gapoktan = $request->alamat_gapoktan;
        $gapoktan->status_gapoktan = $request->status_gapoktan;
        $gapoktan->penyuluh_id = $request->penyuluh_id;
        $gapoktan->kelompok_id = $kelompokGet->id;
        $gapoktan->kecamatan_id = $request->kecamatan_id;
        $gapoktan->kelurahan_id = $request->kelurahan_id;

        $gapoktan->save();

        return redirect()->back()->with('success', 'Berhasil mengubah Gapoktan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gapoktan $gapoktan)
    {
        $gapoktan->delete();
        $kelompok = Kelompok::find($gapoktan->kelompok_id);
        if ($kelompok) {
            $kelompok->delete();
        }
        return redirect()->back()->with('success', 'Berhasil menghapus Gapoktan');
    }

    public function getGapoktan(){
        $gapoktan = Gapoktan::all();
        return response()->json($gapoktan);
    }

    public function getGapoktanById($id){
        $gapoktan = Gapoktan::with('kelompok')->where('id', $id)->first();
        return response()->json($gapoktan);
    }
}