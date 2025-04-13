<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contacto extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'contactos';

    public $fillable = [
        'nombre',
        'telefono',
        'comentario'
    ];

    protected $casts = [
        'nombre' => 'string',
        'telefono' => 'string',
        'comentario' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:55',
        'telefono' => 'required|string|max:8',
        'comentario' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    
}
