<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persona extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'personas';

    public $fillable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido'
    ];

    protected $casts = [
        'primer_nombre' => 'string',
        'segundo_nombre' => 'string',
        'primer_apellido' => 'string',
        'segundo_apellido' => 'string'
    ];

    public static $rules = [
        'primer_nombre' => 'required|string|max:55',
        'segundo_nombre' => 'nullable|string|max:55',
        'primer_apellido' => 'required|string|max:55',
        'segundo_apellido' => 'nullable|string|max:55',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function documentos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Documento::class, 'personas_has_documentos');
    }
}
