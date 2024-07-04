<?php

namespace App\DataTables;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BeritaDataTable extends DataTable
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
        if(auth()->user()->hasRole('admin')){
            $dataTable->addColumn('action', function($data) {
                $getById = route('admin.berita.getBeritaById', $data->id);
                $update = route('admin.berita.update', $data->id);
                $delete = route('admin.berita.destroy', $data->id);
                return "<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-url='$update' data-id='$data->id' data-urlajax='$getById' onclick='editModalBeritaForm(this)' data-target='#editBeritaModal'>Edit</button>
                        <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-url='$delete' onclick='formDelete(this)' data-target='#hapusModal'>Hapus</button>";
            })->setRowId('id');
        }
        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Berita $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Berita $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('berita-table')
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
        return [
            Column::make('judul_berita'),
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
        return 'Berita_' . date('YmdHis');
    }
}
