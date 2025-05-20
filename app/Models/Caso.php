<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caso extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'casos';

    public $fillable = [
        'tipo_id',
        'estado_id',
        'usuario_id'
    ];

    protected $casts = [

    ];

    public static $rules = [
        'tipo_id' => 'required',
        'estado_id' => 'required',
        'usuario_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function estado(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CasoEstado::class, 'estado_id');
    }

    public function tipo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CasoTipo::class, 'tipo_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }

    public function audiencias(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Audiencia::class, 'caso_id');
    }

    public function bitacoraCasos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\BitacoraCaso::class, 'caso_id');
    }

    public function familiarJuicioDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CasoFamiliarJuicioDetalle::class, 'caso_id');
    }

    public function penalDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CasoPenalDetalle::class, 'caso_id');
    }

    public function partesInvolucradas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ParteInvolucradaCasos::class, 'caso_id');
    }
}
