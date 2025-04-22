<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documento_Tipo extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'documento_tipos';

    public $fillable = [
        'nombre',
        'created-at'
    ];

    protected $casts = [
        'nombre' => 'string',
        'created-at' => 'datetime'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:55',
        'created-at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function documentos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Documento::class, 'tipo_id');
    }
}
