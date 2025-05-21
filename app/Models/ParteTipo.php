<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParteTipo extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'parte_tipos';

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

    const DEMANDANTE = 1;
    const DEMANDADO = 2;
    const VICTIMA = 3;
    const VICTIMARIO = 4;
    const COMPARECIENTE = 5;
    const INTERVINIENTE = 6;
    public function parteInvolucradaCasos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ParteInvolucradaCaso::class, 'tipo_id');
    }

    public function parteInvolucradaDocumentos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ParteInvolucradaDocumento::class, 'tipo_id');
    }
}
