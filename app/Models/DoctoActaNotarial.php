<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctoActaNotarial extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'docto_acta_notariales';

    public $fillable = [
        'nombre'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function doctoActaDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\DoctoActaDetalle::class, 'notarial_id');
    }
}
