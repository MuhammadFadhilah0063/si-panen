<?php

namespace App\Http\Controllers;
use App\DataTables\BeritaDataTable;
use App\Models\Berita;
use Image;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BeritaDataTable $table)
    {
        $buttons = '';
        if(auth()->user()->hasRole('admin')){
            $buttons = "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#tambahBerita'><i class='fas fa-sm fa-plus mr-2'></i> Tambah Berita</button>";
        }
        return $table->render('templates.datatable', [
            'title' => 'Berita',
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
        $berita = new Berita();

        $berita->judul_berita = $request->judul_berita;
        $berita->isi_berita = $request->isi_berita;
        $berita->slug = $request->slug;
        
        if ($request->foto) {
            $file = $request->file('foto');
            $photo = Image::make($file->getPathName());
            $path = 'img/berita/' . time() . "_" . $file->getClientOriginalName();
            $photoUrl = $photo->save(public_path($path), 50);
            $berita->foto = $path;
        }
        $berita->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan berita baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        if(!$berita){
            return redirect()->route('dashboard')->with('error', 'Berita tidak ditemukan');
        }
        return view('berita', [
            'title' => 'Berita',
            'berita' => $berita
        ]);
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
    public function update(Request $request, Berita $berita)
    {
        $berita->judul_berita = $request->judul_berita;
        $berita->isi_berita = $request->isi_berita;
        $berita->slug = $request->slug;
        
        if ($request->foto_edit) {
            $file = $request->file('foto_edit');
            $photo = Image::make($file->getPathname());
            $path = 'img/berita/' . time() . "_" . $file->getClientOriginalName();
            $photoUrl = $photo->save(public_path($path), 50);
            $berita->foto = $path;
        }
        $berita->save();


        return redirect()->back()->with('success', 'Berhasil mengubah Berita');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus Berita');
    }

    public function getBeritaById($id)
    {
        $berita = Berita::where('id', $id)->first();
        return response()->json($berita);
    }
}
