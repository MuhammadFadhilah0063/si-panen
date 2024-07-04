<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\HasilPanen;
use Illuminate\Http\Request;
use App\Exports\HasilPanenExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class ExportController extends Controller
{
    public function index()
    {
        return view('auth.export.index', [
            'title' => 'Export Data'
        ]);
    }

    public function export(Request $request)
    {
        $hasil = HasilPanen::with('kecamatan', 'kelurahan')->get();
        // dd($request->all());
        $per = $request->pilih_export;
        $tahun = $request->pilih_tahun; // Mendapatkan tahun dari request
        $bulan = $request->pilih_bulan; // Mendapatkan bulan dari request

        return Excel::download(new HasilPanenExport($per, $tahun, $bulan), 'Hasil Panen - ' . $per . $bulan . $tahun . '.xlsx');
    }

    public function getData(Request $request)
    {
        $namaBulan = [
            '1' => 'januari',
            '2' => 'februari',
            '3' => 'maret',
            '4' => 'april',
            '5' => 'mei',
            '6' => 'juni',
            '7' => 'juli',
            '8' => 'agustus',
            '9' => 'september',
            '10' => 'oktober',
            '11' => 'november',
            '12' => 'desember',
        ];

        if (auth()->user()->hasRole('penyuluh')) {
            if ($request['pilih_export'] != 'Seluruh Daerah') {
                $kecamatan = Kecamatan::where('nama', $request['pilih_export'])->first();
                $totalPanen = HasilPanen::where('kecamatan_id', $kecamatan->id)
                    ->where('penyuluh_id', auth()->user()->id)
                    ->whereMonth('tgl_panen', $request['pilih_bulan'])
                    ->whereYear('tgl_panen', $request['pilih_tahun'])
                    ->sum('hasil_produksi');
                $listPanen = HasilPanen::where('kecamatan_id', $kecamatan->id)
                    ->where('penyuluh_id', auth()->user()->id)
                    ->whereMonth('tgl_panen', $request['pilih_bulan'])
                    ->whereYear('tgl_panen', $request['pilih_tahun'])
                    ->get();
                $dataPanen = [
                    "kecamatan" => $kecamatan->nama,
                    "bulan" => $namaBulan[$request['pilih_bulan']],
                    "tahun" => $request['pilih_tahun'],
                    "total" => round($totalPanen, 3),
                    "data"  => $listPanen
                ];
            } else {
                $totalPanen = HasilPanen::whereMonth('tgl_panen', $request['pilih_bulan'])
                ->whereYear('tgl_panen', $request['pilih_tahun'])
                ->where('penyuluh_id', auth()->user()->id)
                    ->sum('hasil_produksi');
                $listPanen = HasilPanen::whereMonth('tgl_panen', $request['pilih_bulan'])
                ->whereYear('tgl_panen', $request['pilih_tahun'])
                ->where('penyuluh_id', auth()->user()->id)
                    ->get();
                $dataPanen = [
                    "kecamatan" => "seluruh daerah",
                    "bulan" => $namaBulan[$request['pilih_bulan']],
                    "tahun" => $request['pilih_tahun'],
                    "total" => round($totalPanen, 3),
                    "data"  => $listPanen
                ];
            }
        } else {
            if ($request['pilih_export'] != 'Seluruh Daerah') {
                $kecamatan = Kecamatan::where('nama', $request['pilih_export'])->first();
                $totalPanen = HasilPanen::where('kecamatan_id', $kecamatan->id)
                    ->whereMonth('tgl_panen', $request['pilih_bulan'])
                    ->whereYear('tgl_panen', $request['pilih_tahun'])
                    ->sum('hasil_produksi');
                $listPanen = HasilPanen::where('kecamatan_id', $kecamatan->id)
                    ->whereMonth('tgl_panen', $request['pilih_bulan'])
                    ->whereYear('tgl_panen', $request['pilih_tahun'])
                    ->get();
                $dataPanen = [
                    "kecamatan" => $kecamatan->nama,
                    "bulan" => $namaBulan[$request['pilih_bulan']],
                    "tahun" => $request['pilih_tahun'],
                    "total" => round($totalPanen, 3),
                    "data"  => $listPanen
                ];
            } else {
                $totalPanen = HasilPanen::whereMonth('tgl_panen', $request['pilih_bulan'])
                ->whereYear('tgl_panen', $request['pilih_tahun'])
                ->sum('hasil_produksi');
                $listPanen = HasilPanen::whereMonth('tgl_panen', $request['pilih_bulan'])
                ->whereYear('tgl_panen', $request['pilih_tahun'])
                ->get();
                $dataPanen = [
                    "kecamatan" => "seluruh daerah",
                    "bulan" => $namaBulan[$request['pilih_bulan']],
                    "tahun" => $request['pilih_tahun'],
                    "total" => round($totalPanen, 3),
                    "data"  => $listPanen
                ];
            }
        }

        return response()->json(['data_panen' => $dataPanen]);
    }
}