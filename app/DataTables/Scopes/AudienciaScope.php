<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class AudienciaScope implements DataTableScope
{
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        if (request('nombre')) {
            $query->whereHas('partesInvolucradas', function ($q) {
                $q->whereHas('modelable', function ($q2) {
                    $q2->where('primer_nombre', 'like', '%' . request('nombre') . '%')
                        ->orWhere('segundo_nombre', 'like', '%' . request('nombre') . '%')
                        ->orWhere('primer_apellido', 'like', '%' . request('nombre') . '%')
                        ->orWhere('segundo_apellido', 'like', '%' . request('nombre') . '%');
                });
            });
        }

        if (request('casos_id')) {
            if(is_array(request('casos_id'))) {
                $query->whereIn('caso_id', request('casos_id'));
            } else {
                $query->where('caso_id', request('casos_id'));
            }
        }


        if (request('rango_fechas')) {
            $query->whereBetween('fecha', campoRangoFechas(request('rango_fechas')));
        }

         return $query;
    }
}
