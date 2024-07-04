<?php

namespace App\DataTables;

use App\Models\Gapoktan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GapoktanDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);
        if (Auth::user()->hasRole('admin')) {
            $dataTable->addColumn('action', function ($data) {
                $role = auth()->user()->getRoleNames()[0];
                $getById = route('admin.gapoktan.getGapoktanById', $data->id);
                $update = route('admin.gapoktan.update', $data->id);
                $delete = route('admin.gapoktan.destroy', $data->id);
                return "<button type='button' class='btn btn-sm btn-warning mb-2' data-toggle='modal' data-role='$role' data-url='$update' data-id='$data->id' data-urlajax='$getById' onclick='editModalGapoktanForm(this)' data-target='#editGapoktanModal'>Edit</button>
                        <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-url='$delete' onclick='formDelete(this)' data-target='#hapusModal'>Hapus</button>";
            })
            ->setRowId('id');
        }
        if(Auth::user()->hasRole('penyuluh')){
            $dataTable->addColumn('action', function ($data){
                $role = auth()->user()->getRoleNames()[0];
                $getById = route('penyuluh.gapoktan.getGapoktanById', $data->id);
                $update = route('penyuluh.gapoktan.update', $data->id);
                $delete = route('penyuluh.gapoktan.destroy', $data->id);

                return "<button type='button' class='btn btn-sm btn-warning mb-2' data-toggle='modal' data-role='$role' data-url='$update' data-id='$data->id' data-urlajax='$getById' onclick='editModalGapoktanForm(this)' data-target='#editGapoktanModal'>Edit</button>
                        <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-url='$delete' onclick='formDelete(this)' data-target='#hapusModal'>Hapus</button>";
            })->setRowId('id');
        }
        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Gapoktan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Gapoktan $model): QueryBuilder
    {
        return $model->newQuery()->with(["kelompok", "penyuluh", "kecamatan", 'kelurahan'])->orderBy('id', 'asc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('gapoktan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        $columns = [
            Column::make('nama_petani')->title('Ketua Tani'),
            Column::make('luas_lahan_gapoktan'),
            Column::make('no_hp_gapoktan'),
            Column::make('alamat_gapoktan'),
            Column::make('status_gapoktan'),
            Column::make('penyuluh.nama_penyuluh')->title('Nama Penyuluh'),
            Column::make('kelompok.nama_kelompok')->title('Nama Kelompok'),
            Column::make('kecamatan.nama')->title('Kecamatan'),
            Column::make('kelurahan.nama')->title('Kelurahan'),
        ];

        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('penyuluh')) {
            $columns[] = Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center')
                ->visible();
        }

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Gapoktan_' . date('YmdHis');
    }
}
