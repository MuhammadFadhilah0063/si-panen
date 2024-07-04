<?php

namespace App\DataTables;

use App\Models\Penyuluh;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PenyuluhDataTable extends DataTable
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
                $get = route('admin.penyuluh.getPenyuluh', $data->id);
                $getById = route('admin.penyuluh.getPenyuluhById', $data->id);
                $update = route('admin.penyuluh.update', $data->id);
                $delete = route('admin.penyuluh.destroy', $data->id);

                return "<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-url='$update' data-id='$data->id' data-urlajax='$getById' data-nama='$data->nama' onclick='editModalPenyuluhForm(this)' data-target='#editPenyuluhModal'>Edit</button>
                        <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-url='$delete' onclick='formDelete(this)' data-target='#hapusModal'>Hapus</button>";
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Penyuluh $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Penyuluh $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('id', 'asc');
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
        $columns = [
            Column::make('nama_penyuluh'),
            Column::make('nip_penyuluh'),
            Column::make('no_hp_penyuluh'),
            Column::make('alamat_penyuluh'),
        ];
        if(auth()->user()->hasRole('admin')){
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
        return 'Penyuluh_' . date('YmdHis');
    }
}
