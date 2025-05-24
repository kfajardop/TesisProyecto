<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParteInvolucradaDocumento extends Model
{

    use HasFactory;

    public $table = 'parte_involucrada_documentos';

    public $fillable = [
        'model_type',
        'model_id',
        'tipo_id',
        'documento_id'
    ];

    protected $casts = [
        'model_type' => 'string'
    ];

    public static $rules = [
        'model_type' => 'required|string|max:255',
        'model_id' => 'required',
        'tipo_id' => 'required',
        'documento_id' => 'required'
    ];

    public static $messages = [

    ];
    public $timestamps = false;

    public function documento(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Documento::class, 'documento_id');
    }

    public function tipo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ParteTipo::class, 'tipo_id');
    }

    public function modelable()
    {
        return $this->morphTo('model', 'model_type', 'model_id');
    }
}
