<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'clientes';

    public $fillable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'dpi',
        'telefono',
        'direccion_id'
    ];

    protected $casts = [
        'primer_nombre' => 'string',
        'segundo_nombre' => 'string',
        'primer_apellido' => 'string',
        'segundo_apellido' => 'string',
        'dpi' => 'string',
        'telefono' => 'string'
    ];

    public static $rules = [
        'primer_nombre' => 'required|string|max:55',
        'segundo_nombre' => 'nullable|string|max:55',
        'primer_apellido' => 'required|string|max:55',
        'segundo_apellido' => 'nullable|string|max:55',
        'dpi' => 'nullable|string|max:13',
        'telefono' => 'nullable|string|max:8',
        'direccion_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function direccion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Direccion::class, 'direccion_id');
    }
}
