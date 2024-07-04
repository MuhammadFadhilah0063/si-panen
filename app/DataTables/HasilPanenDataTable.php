<?php

namespace App\DataTables;

use App\Models\HasilPanen;
use App\Models\Gapoktan;
use App\Models\Poktan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HasilPanenDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('kelompok', function ($data) {
            //jika kelompok_id tidak null maka cetak kelompok "Gapoktan" jika null maka cetak kelompok "Poktan"
            if ($data->kelompok_id != null) {
                return "Gapoktan";
            } else {
                return "Poktan";
            }
            })
            ->addColumn('action', function($data) {
                $role = auth()->user()->getRoleNames();
                $get = route('hasil-panen.getHasilPanen', $data->id);
                $show = route("$role[0].hasil-panen.show", $data->id);
                $edit = route("$role[0].hasil-panen.edit", $data->id);
                $delete = route("$role[0].hasil-panen.destroy", $data->id);
                $getVerifikasi = route("hasil-panen.getVerifikasi", $data->id);
                $updateVerifikasi = route("hasil-panen.updateVerifikasi", $data->id);

                if(url()->current() == route('hasil-panen')) {
                    return "<button type='button' class='btn btn-sm btn-primary' data-bs-toggle='modal' data-urlajax='$get' onclick='detailHasilPanen(this)' data-bs-target='#detailModal'>Detail</button>";
                }
                if($role[0] === 'kabid') {
                    return "<button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-urlajax='$get' data-url='$updateVerifikasi' onclick='updateVerifikasiForm(this)' data-target='#verifikasiModal'>Verifikasi</button>
                            <a href='$show' class='btn btn-sm btn-primary'>Detail</a>";
                }else if($role[0] === 'admin'){
                    return "<button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-urlajax='$get' data-url='$updateVerifikasi' onclick='updateVerifikasiForm(this)' data-target='#verifikasiModal'>Verifikasi</button>
                            <a href='$show' class='btn btn-sm btn-primary'>Detail</a>
                            <a href='$edit' class='btn btn-sm btn-warning'>Edit</a>
                            <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-url='$delete' onclick='formDelete(this)' data-target='#hapusModal'>Hapus</button>";
                }else{
                    return "<a href='$show' class='btn btn-sm btn-primary'>Detail</a>
                            <a href='$edit' class='btn btn-sm btn-warning'>Edit</a>
                            <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-url='$delete' onclick='formDelete(this)' data-target='#hapusModal'>Hapus</button>";
                }
                
            })
            ->editColumn('gkp', function($data) {
                return "$data->gkp Kg";
            })
            ->editColumn('gkg', function($data) {
                return "$data->gkg Kg";
            })
            ->editColumn('hasil_produksi', function($data) {
                return "$data->hasil_produksi Ton";
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\HasilPanen $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HasilPanen $model): QueryBuilder
    {
        // Filter berdasarkan bulan dan tahun dari request
        $bulan = $this->request->input('month');
        $tahun = $this->request->input('year');

        $penyuluh = \App\Models\Penyuluh::where('nama_penyuluh', auth()->user()->name)->first();
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('kabid')) {
            if (isset($bulan) && isset($tahun)) {

                return $model->newQuery()->with(['kecamatan', 'kelurahan', 'penyuluh', 'user'])
                ->orderBy('hasil_produksi', 'desc')
                ->where('kecamatan_id', $this->kecamatan_id)
                    ->whereMonth('tgl_panen', $bulan)
                    ->whereYear('tgl_panen', $tahun)
                    ->take(10);
            } else {
                return $model->newQuery()->with(['kecamatan', 'kelurahan', 'penyuluh', 'user'])->orderBy('hasil_produksi', 'desc')->where('kecamatan_id', $this->kecamatan_id)->take(10);
            }
        } else if (auth()->user()->hasRole('penyuluh')) {
            if (isset($bulan) && isset($tahun)) {
                return $model->newQuery()->with(['kecamatan', 'kelurahan', 'penyuluh', 'user'])
                ->orderBy('hasil_produksi', 'desc')
                ->where('penyuluh_id', $penyuluh->id)
                ->where('kecamatan_id', $this->kecamatan_id)
                    ->whereMonth('tgl_panen', $bulan)
                    ->whereYear('tgl_panen', $tahun)
                    ->take(10);
            } else {
                return $model->newQuery()->with(['kecamatan', 'kelurahan', 'penyuluh', 'user'])->orderBy('hasil_produksi', 'desc')->where('penyuluh_id', $penyuluh->id)->where('kecamatan_id', $this->kecamatan_id)->take(10);
            }
        }

        if (isset($bulan) && isset($tahun)) {
            return $model->newQuery()->with(['kecamatan', 'kelurahan', 'penyuluh', 'user'])
            ->where('user_id', auth()->user()->id)
            ->orderBy('hasil_produksi', 'desc')
            ->where('kecamatan_id', $this->kecamatan_id)
            ->whereMonth('tgl_panen', $bulan)
            ->whereYear('tgl_panen', $tahun)
            ->take(10);
        } else {
            return $model->newQuery()->with([
                'kecamatan', 'kelurahan', 'penyuluh', 'user'
            ])->where('user_id', auth()->user()->id)->orderBy('hasil_produksi', 'desc')->where('kecamatan_id', $this->kecamatan_id)->take(10);
        }
        \Log::info($query->toSql());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('datatableserverside')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lBfrtip')  // l: length changing input control, B: buttons, f: filtering input, r: processing display element, t: table, i: table information summary, p: pagination control
            ->orderBy(1)
            ->buttons(
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            )
            ->initComplete('function(settings, json) {
                    var months = \'<select id="monthFilter" class="form-control form-control-sm inline-block ml-3">\';
                    months += \'<option value="">Pilih Bulan</option>\';
                    var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                    for (var i = 0; i < monthNames.length; i++) {
                        var monthValue = (i + 1).toString().padStart(2, "0");
                        months += \'<option value="\' + monthValue + \'">\' + monthNames[i] + \'</option>\';
                    }
                    months += \'</select>\';

                    var years = \'<select id="yearFilter" class="form-control form-control-sm inline-block ml-1">\';
                    years += \'<option value="">Pilih Tahun</option>\';
                    var currentYear = new Date().getFullYear();
                    for (var i = currentYear; i >= 2000; i--) {
                        years += \'<option value="\' + i + \'">\' + i + \'</option>\';
                    }
                    years += \'</select>\';

                    var searchButton = \'<button type="button" class="btn btn-sm btn-primary font-weight-bold inline-block ml-2" onclick="searchData()">Cari</button>\';

                    $(months).appendTo("#datatableserverside_length");
                    $(years).appendTo("#datatableserverside_length");
                    $(searchButton).appendTo("#datatableserverside_length");
                }');
    }



    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        if($this->guest == 'guest') {
            return [
                Column::make('luas_lahan'),
                Column::make('kelompok_tani'),
                Column::make('petani'),
                Column::make('alamat_ubinan'),
                Column::make('gkp')->title('GKP'),
                Column::make('gkg')->title('GKG'),
                Column::make('hasil_produksi'),
                Column::make('kecamatan.nama')->title("Daerah"),
                Column::computed('action')
                        ->exportable(false)
                        ->printable(false)
                        ->width(100)
                        ->addClass('text-center'),
            ];
        }
        return [
            Column::make('luas_lahan'),
            Column::make('kelompok_tani'),
            Column::make('petani'),
            Column::make('alamat_ubinan'),
            Column::make('gkp')->title('GKP'),
            Column::make('gkg')->title('GKG'),
            Column::make('is_verified')->title('Status Verifikasi'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    // protected function filename(): string
    // {
    //     return 'HasilPanen_' . date('YmdHis');
    // }
}