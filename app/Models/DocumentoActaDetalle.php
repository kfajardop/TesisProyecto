<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentoActaDetalle extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'docto_acta_detalles';

    public $fillable = [
        'fecha',
        'comentario',
        'documento_id',
        'notarial_id'
    ];

    protected $casts = [
        'fecha' => 'date',
        'comentario' => 'string'
    ];

    public static $rules = [
        'fecha' => 'required',
        'comentario' => 'nullable|string|max:255',
        'documento_id' => 'required',
        'notarial_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function notarial(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\DoctoActaNotariale::class, 'notarial_id');
    }

    public function documento(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Documento::class, 'documento_id');
    }
}
