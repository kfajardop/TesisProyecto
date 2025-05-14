<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class CasoFamiliarJuicioTipo extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'caso_familiar_juicio_tipos';

    public $fillable = [
        'nombre'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    const JUICIO_POR_DIVORCIO_VOLUNTARIO = 1;
    const JUICIO_ORAL_DE_DIVORCIO = 2;
    const JUICIO_ORAL_DE_AUMENTO_DE_PENSION_ALIMENTICIA = 3;
    const JUICIO_ORAL_DE_EXTINCION_DE_PENSION_ALIMENTICIA = 4;
    const JUICIO_ORAL_DE_FIJACION_DE_PENSION_ALIMENTICIA = 5;
    const JUICIO_ORAL_DE_FILIACION_Y_PATERNIDAD = 6;
    const JUICIO_EJECUTIVO_EN_LA_VIA_DE_APREMIO = 7;
    const JUICIO_ORAL_DE_RELACIONES_FAMILIARES = 8;

    public function casoFamiliarJuicioDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CasoFamiliarJuicioDetalle::class, 'tipo_juicio_id');
    }

    public function casoFamiliarJuicioEtapas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CasoFamiliarJuicioEtapa::class, 'tipo_juicio_id');
    }
}
