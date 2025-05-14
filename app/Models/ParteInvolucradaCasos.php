<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParteInvolucradaCasos extends Model
{

    use HasFactory;

    public $table = 'parte_involucrada_casos';

    public $fillable = [
        'model_type',
        'model_id',
        'caso_id',
        'tipo_id'
    ];

    protected $casts = [
        'model_type' => 'string'
    ];

    public static $rules = [
        'model_type' => 'required|string|max:255',
        'model_id' => 'required',
        'caso_id' => 'required',
        'tipo_id' => 'required'
    ];

    public $timestamps = false;

    public static $messages = [

    ];

    public function caso(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Caso::class, 'caso_id');
    }

    public function tipo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ParteTipo::class, 'tipo_id');
    }

    public function audiencias(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Audiencia::class, 'audiencias_has_partes_involucradas');
    }

    public function modelable()
    {
        return $this->morphTo('model', 'model_type', 'model_id');
    }


}
