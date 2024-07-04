<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\HasilPanen;
use App\Models\Kelompok;
use App\Models\Poktan;
use App\Models\Gapoktan;
use App\Models\Penyuluh;
use Illuminate\Http\Request;
use App\Models\FotoHasilPanen;
use App\DataTables\HasilPanenDataTable;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use stdClass;

class HasilPanenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HasilPanenDataTable $table)
    {
        return $table->render('templates.datatable', [
            'title' => "Hasil Panen",
            'buttons' => ''
        ]);
    }

    public function hasilPanenGuest(HasilPanenDataTable $table)
    {
        return $table->with('guest', 'guest')->render('hasil-panen', [
            'title' => 'Hasil Panen'
        ]);
    }

    public function showDaerah(HasilPanenDataTable $table, $namaDaerah = null, Request $request)
    {
        $title = "Hasil Panen";
        switch ($namaDaerah) {
            case 'tengah':
                $namaDaerah = 'Banjarmasin Tengah';
                $title = "Hasil Panen daerah Banjarmasin Tengah";
                break;

            case 'selatan':
                $namaDaerah = 'Banjarmasin Selatan';
                $title = "Hasil Panen daerah Banjarmasin Selatan";
                break;

            case 'utara':
                $namaDaerah = 'Banjarmasin Utara';
                $title = "Hasil Panen daerah Banjarmasin Utara";
                break;

            case 'barat':
                $namaDaerah = 'Banjarmasin Barat';
                $title = "Hasil Panen daerah Banjarmasin Barat";
                break;

            case 'timur':
                $namaDaerah = 'Banjarmasin Timur';
                $title = "Hasil Panen daerah Banjarmasin Timur";
                break;

            default:
                break;
        }

        $kecamatan = Kecamatan::where('nama', $namaDaerah)->first();

        if (auth()->user()->hasRole('penyuluh')) {
            $totalPanen = HasilPanen::where('kecamatan_id', $kecamatan->id)
                ->where('penyuluh_id', auth()->user()->id)
                ->sum('hasil_produksi');
            $dataPanen = [
                "total" => $totalPanen
            ];
        } else {
            $totalPanen = HasilPanen::where('kecamatan_id', $kecamatan->id)->sum('hasil_produksi');
            $dataPanen = [
                "total" => $totalPanen
            ];
        }
        

        return $table->with('kecamatan_id', $kecamatan->id)->render('templates.datatable', [
            'title' => $title,
            'buttons' => '',
            'dataPanen' => $dataPanen,
        ]);
    }

    public function getTotalPanen($namaDaerah, Request $request)
    {
        try {

            $namaBulan = [
                '01' => 'januari',
                '02' => 'februari',
                '03' => 'maret',
                '04' => 'april',
                '05' => 'mei',
                '06' => 'juni',
                '07' => 'juli',
                '08' => 'agustus',
                '09' => 'september',
                '10' => 'oktober',
                '11' => 'november',
                '12' => 'desember',
            ];

            switch ($namaDaerah) {
                case 'tengah':
                    $namaDaerah = 'Banjarmasin Tengah';
                    break;

                case 'selatan':
                    $namaDaerah = 'Banjarmasin Selatan';
                    break;

                case 'utara':
                    $namaDaerah = 'Banjarmasin Utara';
                    break;

                case 'barat':
                    $namaDaerah = 'Banjarmasin Barat';
                    break;

                case 'timur':
                    $namaDaerah = 'Banjarmasin Timur';
                    break;

                default:
                    break;
            }

            $kecamatan = Kecamatan::where('nama', $namaDaerah)->first();

            if (auth()->user()->hasRole('penyuluh')) {
                if (isset($request['month']) && isset($request['year'])) {
                    if ($request['month'] != '') {
                        $totalPanen = HasilPanen::where('kecamatan_id', $kecamatan->id)
                            ->where('penyuluh_id', auth()->user()->id)
                            ->whereMonth('tgl_panen', $request['month'])
                            ->whereYear('tgl_panen', $request['year'])
                            ->sum('hasil_produksi');
                        $dataPanen = [
                            "bulan" => $namaBulan[$request['month']],
                            "tahun" => $request['year'],
                            "total" => $totalPanen
                        ];

                        return response()->json(["data" => $dataPanen]);
                    } else {
                        $totalPanen = HasilPanen::where('kecamatan_id', $kecamatan->id)
                            ->where('penyuluh_id', auth()->user()->id)
                            ->sum('hasil_produksi');
                        return response()->json(["data" => $totalPanen]);
                    }
                }
            } else {
                if (isset($request['month']) && isset($request['year'])) {
                    if ($request['month'] != '') {
                        $totalPanen = HasilPanen::where('kecamatan_id', $kecamatan->id)
                            ->whereMonth('tgl_panen', $request['month'])
                            ->whereYear('tgl_panen', $request['year'])
                            ->sum('hasil_produksi');
                        $dataPanen = [
                            "bulan" => $namaBulan[$request['month']],
                            "tahun" => $request['year'],
                            "total" => $totalPanen
                        ];

                        return response()->json(["data" => $dataPanen]);
                    } else {
                        $totalPanen = HasilPanen::where('kecamatan_id', $kecamatan->id)
                            ->sum('hasil_produksi');
                        return response()->json(["data" => $totalPanen]);
                    }
                }
            }
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.hasil-panen.create', [
            'title' => 'Tambah Hasil Panen',
            'kecamatan' => \App\Models\Kecamatan::all(),
            'penyuluh' => \App\Models\Penyuluh::all(),
            'kelurahan' => \App\Models\Kelurahan::all(),
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
        $hasil = new HasilPanen();
        $daerah = Kecamatan::where('id', $request->kecamatan_id)->first();

        $hasil->luas_lahan = $request->luas_lahan;
        $hasil->kelompok_tani = $request->kelompok_tani;
        $hasil->alamat_ubinan = $request->alamat_ubinan;
        $hasil->gkp = $request->gkp;
        $hasil->gkg = $request->gkg;
        $hasil->hasil_produksi = $request->hasil_produksi;
        $hasil->detail_hasil_produksi = $request->detail_hasil_produksi;
        $hasil->url_lokasi = $request->url_lokasi;
        $hasil->kecamatan_id = $request->kecamatan_id;
        $hasil->kelompok_id = $request->kelompok_id;
        $hasil->petani = $request->petani;
        $hasil->kelurahan_id = $request->kelurahan_id;
        $hasil->penyuluh_id = $request->penyuluh_id;
        $hasil->tgl_tanam = $request->tgl_tanam;
        $hasil->tgl_panen = $request->tgl_panen;
        $hasil->user_id = Auth::user()->id;


        $hasil->save();
        if ($request->foto) {
            for ($i = 0; $i < count($request->foto); $i++) {
                $file = $request->file('foto')[$i];
                $photo = Image::make($file->getPathName());
                $path = 'img/hasil-panen/' . time() . "_" . $file->getClientOriginalName();
                $photoUrl = $photo->save(public_path($path), 50);

                FotoHasilPanen::create([
                    'nama' => $path,
                    'hasil_panen_id' => $hasil->id
                ]);
            }
        }

        if (Auth::user()->hasRole('admin')) {
            switch ($daerah->nama) {
                case 'Banjarmasin Tengah':
                    return redirect()->route("admin.hasil-panen.showDaerah", 'tengah')->with('success', 'Data Hasil Panen di daerah Banjarmasin Tengah berhasil ditambahkan!');
                    break;

                case 'Banjarmasin Selatan':
                    return redirect()->route("admin.hasil-panen.showDaerah", 'selatan')->with('success', 'Data Hasil Panen di daerah Banjarmasin Selatan berhasil ditambahkan!');
                    break;

                case 'Banjarmasin Utara':
                    return redirect()->route("admin.hasil-panen.showDaerah", 'utara')->with('success', 'Data Hasil Panen di daerah Banjarmasin Utara berhasil ditambahkan!');
                    break;

                case 'Banjarmasin Barat':
                    return redirect()->route("admin.hasil-panen.showDaerah", 'barat')->with('success', 'Data Hasil Panen di daerah Banjarmasin Barat berhasil ditambahkan!');
                    break;
                case 'Banjarmasin Timur':
                    return redirect()->route("admin.hasil-panen.showDaerah", 'timur')->with('success', 'Data Hasil Panen di daerah Banjarmasin Timur berhasil ditambahkan!');
                    break;
                default:
                    break;
            }

            return redirect()->route("admin.hasil-panen.index")->with('success', 'Berhasil menambahkan hasil panen');
        } else if (Auth::user()->hasRole('penyuluh')) {
            switch ($daerah->nama) {
                case 'Banjarmasin Tengah':
                    return redirect()->route("penyuluh.hasil-panen.showDaerah", 'tengah')->with('success', 'Data Hasil Panen di daerah Banjarmasin Tengah berhasil ditambahkan!');
                    break;

                case 'Banjarmasin Selatan':
                    return redirect()->route("penyuluh.hasil-panen.showDaerah", 'selatan')->with('success', 'Data Hasil Panen di daerah Banjarmasin Selatan berhasil ditambahkan!');
                    break;

                case 'Banjarmasin Utara':
                    return redirect()->route("penyuluh.hasil-panen.showDaerah", 'utara')->with('success', 'Data Hasil Panen di daerah Banjarmasin Utara berhasil ditambahkan!');
                    break;

                case 'Banjarmasin Barat':
                    return redirect()->route("penyuluh.hasil-panen.showDaerah", 'barat')->with('success', 'Data Hasil Panen di daerah Banjarmasin Barat berhasil ditambahkan!');
                    break;
                case 'Banjarmasin Timur':
                    return redirect()->route("penyuluh.hasil-panen.showDaerah", 'timur')->with('success', 'Data Hasil Panen di daerah Banjarmasin Timur berhasil ditambahkan!');
                    break;
                default:
                    break;
            }

            return redirect()->route("penyuluh.hasil-panen.index")->with('success', 'Berhasil menambahkan hasil panen');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HasilPanen  $hasilPanen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hasilPanen = HasilPanen::with('kelurahan', 'kecamatan')->findOrFail($id);
        $namaDaerah = optional(Kecamatan::where('id', $hasilPanen->kecamatan_id)->first())->nama ?? 'Unknown';
        $kelurahan = Kelurahan::where('id', $hasilPanen->kelurahan_id)->first();
        $kecamatan = Kecamatan::where('id', $hasilPanen->kecamatan_id)->first();

        if ($hasilPanen->petani == "Poktan") {
            $kelompok = poktan::where('id', $hasilPanen->kelompok_id)->first();
        } else {
            $kelompok = Gapoktan::where('id', $hasilPanen->kelompok_id)->first();
        }

        // $kelompok_petani = "";
        // if ($gapoktan == null) {
        //     $kelompok_petani = $poktan;
        //     $kelompok_petani->kelompok = "Poktan";
        //     $kelompok_petani->nama_petani = $hasilPanen->kelompok_tani;
        // } else if ($poktan == null) {
        //     $kelompok_petani = $gapoktan;
        //     $kelompok_petani->kelompok = "Gapoktan";
        // }

        $urlback = '';
        if (auth()->user()->hasRole('admin')) {
            $route = 'admin';
        } else if (auth()->user()->hasRole('penyuluh')) {
            $route = 'penyuluh';
        } else if (auth()->user()->hasRole('petani')) {
            $route = 'petani';
        } else if (auth()->user()->hasRole('kabid')) {
            $route = 'kabid';
        }

        switch ($namaDaerah) {
            case 'Banjarmasin Tengah':
                $urlback = route($route . '.hasil-panen.showDaerah', 'tengah');
                break;

            case 'Banjarmasin Selatan':
                $urlback = route($route . '.hasil-panen.showDaerah', 'selatan');
                break;

            case 'Banjarmasin Utara':
                $urlback = route($route . '.hasil-panen.showDaerah', 'utara');
                break;

            case 'Banjarmasin Barat':
                $urlback = route($route . '.hasil-panen.showDaerah', 'barat');
                break;

            default:
                break;
        }

        return view('auth.hasil-panen.show', [
            'title' => 'Detail Hasil Panen',
            'data' => $hasilPanen,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'kelompok_petani' => $kelompok,
            'urlback' => $urlback,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HasilPanen  $hasilPanen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hasilPanen = HasilPanen::findOrFail($id);
        $penyuluh = Penyuluh::all();
        $kecamatan = Kecamatan::all();

        // Use optional() to handle potential null values and avoid errors
        $namaDaerah = optional(Kecamatan::where('id', $hasilPanen->kecamatan_id)->first())->nama ?? 'Unknown';
        $kelurahan = Kelurahan::where('kecamatan_id', $hasilPanen->kecamatan_id)->get();
        $kelompok = Kelompok::where('id', $hasilPanen->kelompok_id)->first();

        $gapoktanAll = Gapoktan::all();
        $poktanAll = Poktan::all();
        $kelompok_petani = "";
        $poktan = '';
        $gapoktan = Gapoktan::where('kelompok_id', optional($kelompok)->id)->first();
        $poktan = Poktan::where('kelompok_id', optional($kelompok)->id)->first();

        if ($gapoktan == null) {
            $kelompok_petani = $poktan;
            if ($kelompok_petani) {
                $kelompok_petani->kelompok = "Poktan";
            }
        } else if ($poktan == null) {
            $kelompok_petani = $gapoktan;
            if ($kelompok_petani) {
                $kelompok_petani->kelompok = "Gapoktan";
            }
        }

        // Handle case when both $gapoktan and $poktan are null
        if ($kelompok_petani == null) {
            $kelompok_petani = new stdClass();
            $kelompok_petani->kelompok = "Unknown";
        }


        $urlback = '';
        $route = auth()->user()->hasRole('admin') ? 'admin' : 'penyuluh';
        switch ($namaDaerah) {
            case 'Banjarmasin Tengah':
                $urlback = route($route . '.hasil-panen.showDaerah', 'tengah');
                break;

            case 'Banjarmasin Selatan':
                $urlback = route($route . '.hasil-panen.showDaerah', 'selatan');
                break;

            case 'Banjarmasin Utara':
                $urlback = route($route . '.hasil-panen.showDaerah', 'utara');
                break;

            case 'Banjarmasin Barat':
                $urlback = route($route . '.hasil-panen.showDaerah', 'barat');
                break;

            default:
                break;
        }
        // dd($poktan, $gapoktan);
        return view('auth.hasil-panen.edit', [
            'title' => 'Edit Hasil Panen',
            'data' => $hasilPanen,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'penyuluh' => $penyuluh,
            'kelompok_petani' => $kelompok_petani,
            'gapoktanAll' => $gapoktanAll,
            'poktanAll' => $poktanAll,
            'gapoktanOrPoktan' => $poktan == null ? $gapoktan : $poktan,
            'urlback' => $urlback,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HasilPanen  $hasilPanen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $hasil = HasilPanen::findOrFail($id);

        $hasil->luas_lahan = $request->luas_lahan;
        $hasil->kelompok_tani = $request->kelompok_tani;
        $hasil->alamat_ubinan = $request->alamat_ubinan;
        $hasil->gkp = $request->gkp;
        $hasil->gkg = $request->gkg;
        $hasil->tgl_tanam = $request->tgl_tanam;
        $hasil->tgl_panen = $request->tgl_panen;
        $hasil->hasil_produksi = $request->hasil_produksi;
        $hasil->detail_hasil_produksi = $request->detail_hasil_produksi;
        $hasil->url_lokasi = $request->url_lokasi;
        $hasil->kecamatan_id = $request->kecamatan_id;
        $hasil->kelurahan_id = $request->kelurahan_id;
        $hasil->kelompok_id = $request->kelompok_id;
        $hasil->petani = $request->petani;
        $hasil->penyuluh_id = $request->penyuluh_id;

        if ($request->file_checked) {
            foreach ($request->file_checked as $key => $value) {
                $foto = FotoHasilPanen::findOrFail($key);
                if (File::exists(public_path($foto->nama))) {
                    File::delete(public_path($foto->nama));
                }
                $foto->delete();
            }
        }

        if ($request->foto) {
            foreach ($request->foto as $key => $value) {
                if ($value != null) {
                    $file = $request->file('foto')[$key];
                    $photo = Image::make($file->getPathName());
                    $path = 'img/hasil-panen/' . time() . "_" . $file->getClientOriginalName();
                    $photoUrl = $photo->save(public_path($path), 50);

                    FotoHasilPanen::create([
                        'nama' => $path,
                        'hasil_panen_id' => $hasil->id
                    ]);
                }
            }
        }

        $hasil->save();

        return redirect()->back()->with('success', 'Berhasil mengubah hasil panen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HasilPanen  $hasilPanen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hasil = HasilPanen::findOrFail($id);
        $hasil->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus hasil panen');
    }

    public function getHasilPanen($id)
    {
        $hasil = HasilPanen::where('id', $id)->with(['kelurahan', 'kecamatan', 'foto_hasil'])->first();
        return response()->json($hasil);
    }

    public function getVerifikasi($id)
    {
        $hasil = HasilPanen::where('id', $id)->first();
        return response()->json($hasil);
    }

    public function updateVerifikasi(Request $request, $id)
    {
        $hasil = HasilPanen::where('id', $id)->first();
        $hasil->is_verified = $request->is_verified;
        $hasil->save();
        return redirect()->back()->with('success', 'Berhasil verifikasi hasil panen');
    }

    public function destroyImage($id)
    {
        try {
            $image = FotoHasilPanen::findOrFail($id);

            // Add your logic to delete the image file from storage, if necessary
            Storage::delete($image->nama);

            $image->delete();

            return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}