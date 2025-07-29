<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class DocumentoScope implements DataTableScope
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

        if (request('estados_id')) {
            if(is_array(request('estados_id'))) {
                $query->whereIn('estado_id', request('estados_id'));
            } else {
                $query->where('estado_id', request('estados_id'));
            }
        }

        if (request('rango_fechas')) {
            $fechas = campoRangoFechas(request('rango_fechas'));

            if ($query->clone()->whereHas('doctoActaDetalles')->exists()) {
                $query->whereHas('doctoActaDetalles', function ($q) use ($fechas) {
                    $q->whereBetween('fecha', $fechas);
                });
            } elseif ($query->clone()->whereHas('doctoPrivadoDetalles')->exists()) {
                $query->whereHas('doctoPrivadoDetalles', function ($q) use ($fechas) {
                    $q->whereBetween('fecha', $fechas);
                });
            } elseif ($query->clone()->whereHas('doctoPublicoDetalles')->exists()) {
                $query->whereHas('doctoPublicoDetalles', function ($q) use ($fechas) {
                    $q->whereBetween('fecha_escritura', $fechas);
                });
            }
        }

        return $query;
    }
}
