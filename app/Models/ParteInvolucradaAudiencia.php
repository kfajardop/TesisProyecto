<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParteInvolucradaAudiencia extends Model
{

    use HasFactory;

    public $table = 'parte_involucrada_audiencias';

    public $fillable = [
        'model_type',
        'model_id',
        'tipo_id',
        'audiencia_id'
    ];

    protected $casts = [
        'model_type' => 'string'
    ];

    public $timestamps = false;

    public static $rules = [
        'model_type' => 'required|string|max:255',
        'model_id' => 'required',
        'tipo_id' => 'required',
        'audiencia_id' => 'required'
    ];

    public static $messages = [

    ];

    public function audiencia(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Audiencia::class, 'audiencia_id');
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
