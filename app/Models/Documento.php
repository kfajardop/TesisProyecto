<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documento extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'documentos';

    public $fillable = [
        'tipo_id',
        'estado_id',
        'usuario_id'
    ];

    protected $appends = [
        'fecha_documento'
    ];

    public static $rules = [
        'tipo_id' => 'required',
        'estado_id' => 'required',
        'usuario_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function estado(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\DocumentoEstado::class, 'estado_id');
    }

    public function tipo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\DocumentoTipo::class, 'tipo_id');
    }

    public function usuario(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }

    public function bitacoras(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\BitacoraDocumento::class, 'documento_id');
    }

    public function doctoActaDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\DocumentoActaDetalle::class, 'documento_id');
    }

    public function doctoPrivadoDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\DocumentoPrivadoDetalle::class, 'documento_id');
    }

    public function doctoPublicoDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\DocumentoPublicoDetalle::class, 'documento_id');
    }

    public function partesInvolucradas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ParteInvolucradaDocumento::class, 'documento_id');
    }

    public function personas(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Persona::class, 'personas_has_documentos');
    }

    public function guardarEnBitacora($titulo, $mensaje)
    {
        $this->bitacoras()
            ->create([
                'usuario_id' => auth()->user()->id,
                'titulo' => $titulo,
                'descripcion' => $mensaje,
            ]);
    }

    public function comparecientes()
    {
        return $this->partesInvolucradas
            ->where('tipo_id', ParteTipo::COMPARECIENTE)
            ->map(fn($parte) => $parte->modelable)
            ->values();
    }

    public function intervinientes()
    {
        return $this->partesInvolucradas
            ->where('tipo_id', ParteTipo::INTERVINIENTE)
            ->map(fn($parte) => $parte->modelable)
            ->values();
    }

    public function getFechaDocumentoAttribute()
    {
        if ($this->doctoPublicoDetalles->count() > 0) {
            return $this->doctoPublicoDetalles[0]->fecha_escritura;
        } elseif ($this->doctoPrivadoDetalles->count() > 0) {
            return $this->doctoPrivadoDetalles[0]->fecha;
        } elseif ($this->doctoActaDetalles->count() > 0) {
            return $this->doctoActaDetalles[0]->fecha;
        }

        return null;

    }
}
