<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentoPublicoDetalle extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'docto_publico_detalles';

    public $fillable = [
        'no_escritura',
        'fecha_escritura',
        'comentario',
        'documento_id',
        'escritura_id'
    ];

    protected $casts = [
        'no_escritura' => 'string',
        'fecha_escritura' => 'date',
        'comentario' => 'string'
    ];

    public static $rules = [
        'no_escritura' => 'required|string|max:20',
        'fecha_escritura' => 'required',
        'comentario' => 'nullable|string|max:255',
        'documento_id' => 'required',
        'escritura_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function escritura(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\DoctoPublicoEscritura::class, 'escritura_id');
    }

    public function documento(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Documento::class, 'documento_id');
    }
}
