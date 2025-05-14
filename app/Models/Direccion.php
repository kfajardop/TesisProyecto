<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Direccion extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'direcciones';

    public $fillable = [
        'direccion',
        'municipio_id'
    ];

    protected $casts = [
        'direccion' => 'string'
    ];

    public static $rules = [
        'direccion' => 'required|string|max:55',
        'municipio_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];
    protected $appends = [
        'direccion_completa'
    ];

    public function municipio(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Municipio::class, 'municipio_id');
    }

    public function clientes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Cliente::class, 'direccion_id');
    }

    public function getDireccionCompletaAttribute()
    {
        return $this->direccion . ', ' . $this->municipio->nombre . ', ' . $this->municipio->departamento->nombre;

    }
}
