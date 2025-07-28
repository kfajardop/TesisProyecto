<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class CasoScope implements DataTableScope
{
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        if(request('tipo_id')) {
            $query->where('tipo_id', request('tipo_id'));
        }
        if(request('dpi')) {
            $query->whereHas('partesInvolucradas', function ($q) {
                $q->whereHas('modelable', function ($q2) {
                    $q2->where('dpi', request('dpi'));
                });
            });
        }
        if(request('nombre')) {
            $query->whereHas('partesInvolucradas', function ($q) {
                $q->whereHas('modelable', function ($q2) {
                    $q2->where('primer_nombre', 'like', '%' . request('nombre') . '%')
                        ->orWhere('segundo_nombre', 'like', '%' . request('nombre') . '%')
                        ->orWhere('primer_apellido', 'like', '%' . request('nombre') . '%')
                        ->orWhere('segundo_apellido', 'like', '%' . request('nombre') . '%');
                });
            });
        }

         return $query;
    }
}
