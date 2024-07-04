<?php

namespace App\Exports;

use App\Models\HasilPanen;
use App\Models\Kecamatan;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class HasilPanenExport implements FromView, WithEvents, ShouldAutoSize
{
    public function __construct(string $per, string $tahun, string $bulan)
    {
        $this->per = $per;
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    public function registerEvents(): array
    {
        $per = $this->per;
        $tahun = $this->tahun;
        $bulan = $this->bulan;

        return [
            AfterSheet::class => function (AfterSheet $event) use ($per, $tahun, $bulan) {
                // $event->sheet->getDelegate()->getStyle('A1:K14')->getAlignment(Alignment::VERTICAL_CENTER);

                $AlignmentCenter = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER
                    ],
                ];

                $fillHead = [
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FF72a3e0'
                        ]
                    ]
                ];

                $allBorder = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ]
                ];

                if ($per == "Seluruh Daerah") {
                    $kecamatan = Kecamatan::all();
                    $allDataFiltered = []; // Inisialisasi array untuk menyimpan hasil filter

                    foreach ($kecamatan as $kec) {
                        $data = HasilPanen::with('kecamatan', 'kelurahan')
                            ->where('kecamatan_id', $kec->id)
                            ->get();

                        // Filter data berdasarkan tahun dan bulan
                        $dataFiltered = $data->filter(function ($hasil) use ($tahun, $bulan) {
                            $tanggal = Carbon::createFromFormat('Y-m-d', $hasil->tgl_panen);
                            $tahunData = $tanggal->format('Y');
                            $bulanData = $tanggal->format('m');

                            return $tahunData == $tahun && $bulanData == $bulan;
                        });

                        // Tambahkan hasil filter dari setiap iterasi ke dalam array
                        $allDataFiltered = array_merge($allDataFiltered, $dataFiltered->toArray());
                    }

                    // Debugging: tampilkan seluruh hasil filter setelah loop
                } else {
                    $kecamatan = Kecamatan::where('nama', $per)->first();
                    $data = HasilPanen::with('kecamatan', 'kelurahan')
                        ->where('kecamatan_id', $kecamatan->id)
                        ->get();

                    // Filter data berdasarkan tahun dan bulan
                    $dataFiltered = $data->filter(function ($hasil) use ($tahun, $bulan) {
                        $tanggal = Carbon::createFromFormat('Y-m-d', $hasil->tgl_panen);
                        $tahunData = $tanggal->format('Y');
                        $bulanData = $tanggal->format('m');

                        return $tahunData == $tahun && $bulanData == $bulan;
                    });

                    $allDataFiltered = [];

                    // Tambahkan hasil filter dari setiap iterasi ke dalam array
                    $allDataFiltered = array_merge($allDataFiltered, $dataFiltered->toArray());

                    foreach ($dataFiltered as $hasil) {
                        $tanggal = Carbon::createFromFormat('Y-m-d', $hasil->tgl_panen)->format('Y-m-d');
                        $hasil->tgl_panen = $tanggal;
                    }
                }

                // Head
                $event->getDelegate()->getStyle('A1:M1');

                $event->getDelegate()->getStyle('A1:M' . count($allDataFiltered) + 2)->applyFromArray($AlignmentCenter);
                $event->getDelegate()->getStyle('A1:M' . count($allDataFiltered) + 2)->applyFromArray($allBorder);

                $event->getDelegate()->getStyle('A1:M1')->applyFromArray($fillHead);
                $event->getDelegate()->getStyle('A1:M1')->getFont()->setSize(14);
                $event->getDelegate()->getStyle('A1:M1')->getFont()->setBold(true);
                $event->getDelegate()->getRowDimension('1')->setRowHeight(30);
            }
        ];
    }

    public function view(): View
    {
        $per = $this->per;
        $tahun = $this->tahun;
        $bulan = $this->bulan;
        $allDataFiltered = []; // Inisialisasi array untuk menyimpan hasil filter

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

        $hasil = HasilPanen::with('kecamatan', 'kelurahan')->get();
        if ($per == "Seluruh Daerah") {
            $kecamatan = Kecamatan::all();

            foreach ($kecamatan as $kec) {
                if (auth()->user()->hasRole('penyuluh')) {
                    $data = HasilPanen::with('kecamatan', 'kelurahan')
                    ->where('penyuluh_id', auth()->user()->id)
                        ->where('kecamatan_id', $kec->id)
                        ->get();
                } else {
                    $data = HasilPanen::with('kecamatan', 'kelurahan')
                    ->where('kecamatan_id', $kec->id)
                        ->get();
                }

                $dataFiltered = $data->filter(function ($hasil) use ($tahun, $bulan) {
                    $tanggal = Carbon::createFromFormat('Y-m-d', $hasil->tgl_panen);
                    $tahunData = $tanggal->format('Y');
                    $bulanData = $tanggal->format('m');

                    return $tahunData == $tahun && $bulanData == $bulan;
                });

                if (auth()->user()->hasRole('penyuluh')) {
                    $totalPanen = HasilPanen::whereMonth('tgl_panen', $bulan)
                    ->whereYear('tgl_panen', $tahun)
                    ->where('penyuluh_id', auth()->user()->id)
                        ->sum('hasil_produksi');
                } else {
                    $totalPanen = HasilPanen::whereMonth('tgl_panen', $bulan)
                    ->whereYear('tgl_panen', $tahun)
                    ->sum('hasil_produksi');
                }

                // Tambahkan hasil filter dari setiap iterasi ke dalam array
                $allDataFiltered = array_merge($allDataFiltered, $dataFiltered->toArray());
            }

            $dataPanen = [
                "kecamatan" => "seluruh daerah",
                "bulan" => $namaBulan[$bulan],
                "tahun" => $tahun,
                "total" => $totalPanen
            ];

            // Debugging: tampilkan seluruh hasil filter setelah loop
            // dd($allDataFiltered);
        } else {
            $kecamatan = Kecamatan::where('nama', $per)->first();

            if (auth()->user()->hasRole('penyuluh')) {
                $data = HasilPanen::with('kecamatan', 'kelurahan')
                    ->where('penyuluh_id', auth()->user()->id)
                ->where('kecamatan_id', $kecamatan->id)
                ->get();
            } else {
                $data = HasilPanen::with('kecamatan', 'kelurahan')
                ->where('kecamatan_id', $kecamatan->id)
                ->get();
            }

            $dataFiltered = $data->filter(function ($hasil) use ($tahun, $bulan) {
                $tanggal = Carbon::createFromFormat('Y-m-d', $hasil->tgl_panen);
                $tahunData = $tanggal->format('Y');
                $bulanData = $tanggal->format('m');

                return $tahunData == $tahun && $bulanData == $bulan;
            });

            foreach ($dataFiltered as $hasil) {
                $tanggal = Carbon::createFromFormat('Y-m-d', $hasil->tgl_panen)->format('Y-m-d');
                $hasil->tgl_panen = $tanggal;
            }

            if (auth()->user()->hasRole('penyuluh')) {
                $totalPanen = HasilPanen::where('kecamatan_id', $kecamatan->id)
                    ->whereMonth('tgl_panen', $bulan)
                    ->whereYear('tgl_panen', $tahun)
                    ->where('penyuluh_id', auth()->user()->id)
                    ->sum('hasil_produksi');
            } else {
                $totalPanen = HasilPanen::where('kecamatan_id', $kecamatan->id)
                    ->whereMonth('tgl_panen', $bulan)
                    ->whereYear('tgl_panen', $tahun)
                    ->sum('hasil_produksi');
            }


            $dataPanen = [
                "kecamatan" => $kecamatan->nama,
                "bulan" => $namaBulan[$bulan],
                "tahun" => $tahun,
                "total" => $totalPanen
            ];
        }

        if ($per == "Seluruh Daerah") {
            return view('auth.export.seluruh-daerah', [
                'hasil' => $allDataFiltered,
                'panen' => $dataPanen,
            ]);
        } else {
            return view('auth.export.per-daerah', [
                'hasil' => $dataFiltered,
                'panen' => $dataPanen,
            ]);
        }
    }
}