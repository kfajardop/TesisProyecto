<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class BitacoraDocumento extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'bitacora_documentos';

    public $fillable = [
        'titulo',
        'descripcion',
        'usuario_id',
        'documento_id'
    ];

    protected $casts = [
        'titulo' => 'string',
        'descripcion' => 'string'
    ];

    public static $rules = [
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'usuario_id' => 'required',
        'documento_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function documento(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Documento::class, 'documento_id');
    }

    public function usuario(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }
}
