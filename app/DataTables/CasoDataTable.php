<?php

namespace App\DataTables;

use App\Models\Caso;
use App\Models\ParteTipo;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class CasoDataTable extends DataTable
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
            ->addColumn('action', function(Caso $caso){
                $id = $caso->id;
                return view('casos.datatables_actions',compact('caso','id'));
            })
            ->editColumn('id',function (Caso $caso){

                return $caso->id;

            })
            ->editColumn('demandantes', function (Caso $caso) {
                $lista = '<ul style="padding-left: 18px; margin: 0">';
                foreach ($caso->partesInvolucradas as $parte) {
                    if ($parte->tipo_id == ParteTipo::DEMANDANTE && $parte->modelable) {
                        $lista .= '<li>' . e($parte->modelable->nombre_completo) . '</li>';
                    }
                }
                $lista .= '</ul>';
                return $lista;
            })

            ->editColumn('demandados', function (Caso $caso) {
                $lista = '<ul style="padding-left: 18px; margin: 0">';
                foreach ($caso->partesInvolucradas as $parte) {
                    if ($parte->tipo_id == ParteTipo::DEMANDADO && $parte->modelable) {
                        $lista .= '<li>' . e($parte->modelable->nombre_completo) . '</li>';
                    }
                }
                $lista .= '</ul>';
                return $lista;
            })

            ->editColumn('etapa',function (Caso $caso){

                return $caso->familiarJuicioDetalles()->first()->etapa->nombre;

            })
            ->rawColumns(['action', 'demandantes', 'demandados']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Caso $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Caso $model)
    {
        return $model->newQuery()
            ->with([
                'tipo',
                'partesInvolucradas',
                'familiarJuicioDetalles.etapa',
            ])
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
                    <"row mb-2"
                    <"col-sm-12 col-md-6" B>
                    <"col-sm-12 col-md-6" f>
                    >
                    rt
                    <"row"
                    <"col-sm-6 order-2 order-sm-1" ip>
                    <"col-sm-6 order-1 order-sm-2 text-right" l>
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
            Column::make('tipo.nombre')
                ->title('Tipo')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false),

            Column::make('demandantes')
                ->title('Demandantes')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false),

            Column::make('demandados')
                ->title('Demandados')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false),

            Column::make('etapa')
                ->title('Etapa')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false),

            Column::computed('action')
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
        return 'casos_datatable_' . time();
    }
}
