<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class BitacoraCaso extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'bitacora_casos';

    public $fillable = [
        'titulo',
        'descripcion',
        'usuario_id',
        'caso_id'
    ];

    protected $casts = [
        'descripcion' => 'string'
    ];

    public static $rules = [
        'descripcion' => 'required|string|max:65535',
        'usuario_id' => 'required',
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

    public function usuario(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }
}
