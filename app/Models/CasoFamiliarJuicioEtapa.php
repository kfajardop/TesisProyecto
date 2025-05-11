<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class CasoFamiliarJuicioEtapa extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'caso_familiar_juicio_etapas';

    public $fillable = [
        'nombre',
        'tipo_juicio_id'
    ];

    protected $casts = [
        'nombre' => 'string',
        'tipo_juicio_id' => 'integer'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'tipo_juicio_id' => 'required|exists:caso_familiar_juicio_tipos,id',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function casoFamiliarJuicios(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CasoFamiliarJuicio::class, 'juicio_etapas_id');
    }

    public function tipoJuicio(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CasoFamiliarJuicioTipo::class, 'tipo_juicio_id');
    }
}
