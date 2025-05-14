<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class CasoFamiliarJuicioDetalle extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'caso_familiar_juicio_detalles';

    public $fillable = [
        'nombre',
        'juicio_etapa_id',
        'caso_id',
        'tipo_juicio_id'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static $rules = [
        'nombre' => 'nullable|string|max:255',
        'juicio_etapa_id' => 'required',
        'caso_id' => 'required',
        'tipo_juicio_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function caso(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Caso::class, 'caso_id');
    }

    public function etapa(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CasoFamiliarJuicioEtapa::class, 'juicio_etapa_id');
    }

    public function tipoJuicio(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CasoFamiliarJuicioTipo::class, 'tipo_juicio_id');
    }
}
