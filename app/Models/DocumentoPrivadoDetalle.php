<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentoPrivadoDetalle extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'docto_privado_detalles';

    public $fillable = [
        'fecha',
        'comentario',
        'documento_id',
        'contrato_id'
    ];

    protected $casts = [
        'fecha' => 'date',
        'comentario' => 'string'
    ];

    public static $rules = [
        'fecha' => 'required',
        'comentario' => 'nullable|string|max:255',
        'documento_id' => 'required',
        'contrato_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function contrato(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\DoctoPrivadoContrato::class, 'contrato_id');
    }

    public function documento(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Documento::class, 'documento_id');
    }
}
