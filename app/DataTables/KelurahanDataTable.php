<?php

namespace App\DataTables;

use App\Models\Kelurahan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KelurahanDataTable extends DataTable
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
            ->addColumn('action', function ($data) {
                $get = route('admin.kelurahan.getKelurahan', $data->id);
                $update = route('admin.kelurahan.update', $data->id);
                $delete = route('admin.kelurahan.destroy', $data->id);

                return "<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-url='$update' data-urlajax='$get' onclick='editModalKelForm(this)' data-target='#editKelurahanModal'>Edit</button>
                        <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-url='$delete' onclick='formDelete(this)' data-target='#hapusModal'>Hapus</button>";
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Kelurahan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Kelurahan $model)
    {
        return $model->newQuery()->with('kecamatan');
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
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('kecamatan.nama')->title('Kecamatan'),
            Column::make('nama')->title('kelurahan'),
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
    protected function filename(): string
    {
        return 'Kelurahan_' . date('YmdHis');
    }
}
