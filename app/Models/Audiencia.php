<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audiencia extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'audiencias';

    public $fillable = [
        'fecha',
        'hora',
        'lugar',
        'caso_id'
    ];

    protected $casts = [
        'fecha' => 'date',
        'lugar' => 'string'
    ];

    public static $rules = [
        'fecha' => 'required',
        'hora' => 'required',
        'lugar' => 'required|string|max:255',
        'caso_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function caso(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Caso::class, 'caso_id');
    }

    public function partesInvolucradas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ParteInvolucradaAudiencia::class, 'audiencia_id');
    }
}
