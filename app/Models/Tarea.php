<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarea extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'tareas';

    public $fillable = [
        'nombre',
        'fecha',
        'hora',
        'descripcion',
        'prioridad_id',
        'estado_id'
    ];

    protected $casts = [
        'nombre' => 'string',
        'fecha' => 'date',
        'descripcion' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'fecha' => 'nullable',
        'hora' => 'nullable',
        'descripcion' => 'nullable|string|max:65535',
        'prioridad_id' => 'required',
        'estado_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function estado(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\TareaEstado::class, 'estado_id');
    }

    public function prioridad(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\TareaPrioridad::class, 'prioridad_id');
    }
}
