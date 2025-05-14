<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class CasoPenalDetalle extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'caso_penal_detalles';

    public $fillable = [
        'no_causa',
        'no_expediente',
        'caso_id',
        'delito_id',
        'etapa_id'
    ];

    protected $casts = [
        'no_causa' => 'string',
        'no_expediente' => 'string'
    ];

    public static $rules = [
        'no_causa' => 'required|string|max:10',
        'no_expediente' => 'required|string|max:45',
        'caso_id' => 'required',
        'delito_id' => 'required',
        'etapa_id' => 'required',
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

    public function delito(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CasoPenalDelito::class, 'delito_id');
    }

    public function etapa(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CasoPenalEtapa::class, 'etapa_id');
    }
}
