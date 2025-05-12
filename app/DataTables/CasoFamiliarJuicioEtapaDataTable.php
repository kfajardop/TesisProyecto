<?php

namespace App\DataTables;

use App\Models\CasoFamiliarJuicioEtapa;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class CasoFamiliarJuicioEtapaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)

            ->addColumn('tipo_juicio', function (CasoFamiliarJuicioEtapa $row) {
                return $row->tipoJuicio->nombre ?? 'No definido';
            })

            ->filterColumn('tipo_juicio', function($query, $keyword) {
                $query->whereHas('tipoJuicio', function($q) use ($keyword) {
                    $q->where('nombre', 'LIKE', "%{$keyword}%");
                });
            })

            ->addColumn('action', function(CasoFamiliarJuicioEtapa $casoFamiliarJuicioEtapa){
                $id = $casoFamiliarJuicioEtapa->id;
                return view('caso_familiar_juicio_etapas.datatables_actions',compact('casoFamiliarJuicioEtapa','id'));
            })
            ->editColumn('id',function (CasoFamiliarJuicioEtapa $casoFamiliarJuicioEtapa){

                return $casoFamiliarJuicioEtapa->id;

            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CasoFamiliarJuicioEtapa $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CasoFamiliarJuicioEtapa $model)
    {
        return $model->newQuery()
            ->with('tipoJuicio')

            ->select($model->getTable().'.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->ajax([
                'data' => "function(data) { formatDataDataTables($('#formFiltersDatatables').serializeArray(), data);   }"
                ])
                ->info(true)
                ->language(['url' => asset('js/SpanishDataTables.json')])
                ->responsive(true)
                ->stateSave(false)
                ->orderBy(1,'desc')

                ->dom('
                        <"row mb-3"
                            <"col-12" B>
                        >
                        <"row mb-3"
                            <"col-12 col-md-6 mb-2 mb-md-0" l>
                            <"col-12 col-md-6 text-md-right" f>
                        >
                        rt
                        <"d-flex flex-wrap justify-content-between align-items-center mt-2"
                            <"dataTables_info" i>
                            <"dataTables_paginate" p>
                        >
                    ')

            ->buttons(

                    Button::make('reset')
                        ->addClass('')
                        ->text('<i class="fa fa-undo"></i> <span class="d-none d-sm-inline">Reiniciar</span>'),

                    Button::make('export')
                        ->extend('collection')
                        ->addClass('')
                        ->text('<i class="fa fa-download"></i> <span class="d-none d-sm-inline">Exportar</span>')
                        ->buttons([
                            Button::make('print')
                                ->addClass('dropdown-item')
                                ->text('<i class="fa fa-print"></i> <span class="d-none d-sm-inline"> Imprimir</span>'),
                            Button::make('csv')
                                ->addClass('dropdown-item')
                                ->text('<i class="fa fa-file-csv"></i> <span class="d-none d-sm-inline"> Csv</span>'),
                            Button::make('pdf')
                                ->addClass('dropdown-item')
                                ->text('<i class="fa fa-file-pdf"></i> <span class="d-none d-sm-inline"> Pdf</span>'),
                            Button::make('excel')
                                ->addClass('dropdown-item')
                                ->text('<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline"> Excel</span>'),
                        ]),
                );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('nombre'),
            Column::make('tipo_juicio')->title('Tipo de Juicio'),
            Column::computed('action')->title('Acciones')
                ->exportable(false)
                ->printable(false)
                ->width('20%')
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'caso_familiar_juicio_etapas_datatable_' . time();
    }
}
