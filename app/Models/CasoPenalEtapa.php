<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class CasoPenalEtapa extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'caso_penal_etapas';

    public $fillable = [
        'nombre'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:55',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];


    const PREPARATORIA = 1;
    const INTERMEDIA = 2;
    const JUICIO = 3;
    const IMPUGNACION = 4;
    const EJECUCION = 5;

    public function casoPenalDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CasoPenalDetalle::class, 'etapa_id');
    }
}
