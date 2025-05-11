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

    public function casoFamiliarJuicioDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CasoFamiliarJuicioDetalle::class, 'tipo_juicio_id');
    }

    public function casoFamiliarJuicioEtapas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CasoFamiliarJuicioEtapa::class, 'tipo_juicio_id');
    }
}
