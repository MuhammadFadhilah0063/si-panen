<?php

namespace App\DataTables;

use App\Models\Poktan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PoktanDataTable extends DataTable
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
            $dataTable->addColumn('action', function ($data){
                $role = auth()->user()->getRoleNames()[0];
                $getById = route('admin.poktan.getPoktanById', $data->id);
                $update = route('admin.poktan.update', $data->id);
                $delete = route('admin.poktan.destroy', $data->id);

                return "<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-role='$role' data-url='$update' data-id='$data->id' data-urlajax='$getById' onclick='editModalPoktanForm(this)' data-target='#editPoktanModal'>Edit</button>
                        <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-url='$delete' onclick='formDelete(this)' data-target='#hapusModal'>Hapus</button>";
            })->setRowId('id');
        }
        if(auth()->user()->hasRole('penyuluh'))
        {
            
            $dataTable->addColumn('action', function ($data){
                $role = auth()->user()->getRoleNames()[0];
                $getById = route('penyuluh.poktan.getPoktanById', $data->id);
                $update = route('penyuluh.poktan.update', $data->id);
                $delete = route('penyuluh.poktan.destroy', $data->id);

                return "<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-role='$role' data-url='$update' data-id='$data->id' data-urlajax='$getById' onclick='editModalPoktanForm(this)' data-target='#editPoktanModal'>Edit</button>
                        <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-url='$delete' onclick='formDelete(this)' data-target='#hapusModal'>Hapus</button>";
            })->setRowId('id');
        }
        return $dataTable;  
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Poktan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Poktan $model): QueryBuilder
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
                    ->setTableId('poktan-table')
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
            Column::make('nama_petani'),
            Column::make('luas_lahan_poktan'),
            Column::make('no_hp_poktan'),
            Column::make('alamat_poktan'),
            Column::make('penyuluh.nama_penyuluh')->title('Nama Penyuluh'),
            Column::make('kecamatan.nama')->title('Kecamatan'),
            Column::make('kelurahan.nama')->title('Kelurahan'),
            Column::make('status_poktan'),
        ];

        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('penyuluh')){
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
        return 'Poktan_' . date('YmdHis');
    }
}