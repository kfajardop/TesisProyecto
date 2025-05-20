<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caso extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'casos';

    public $fillable = [
        'tipo_id',
        'estado_id',
        'usuario_id'
    ];

    protected $casts = [

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
        return $this->belongsTo(\App\Models\CasoEstado::class, 'estado_id');
    }

    public function tipo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CasoTipo::class, 'tipo_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }

    public function audiencias(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Audiencia::class, 'caso_id');
    }

    public function bitacoras(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\BitacoraCaso::class, 'caso_id');
    }

    public function familiarJuicioDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CasoFamiliarJuicioDetalle::class, 'caso_id');
    }

    public function penalDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CasoPenalDetalle::class, 'caso_id');
    }

    public function partesInvolucradas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ParteInvolucradaCasos::class, 'caso_id');
    }

    public function personasDemandantes()
    {
        return $this->partesInvolucradas
            ->where('tipo_id', ParteTipo::DEMANDANTE)
            ->map(fn($parte) => $parte->modelable)
            ->values();
    }

    public function personasDemandadas()
    {
        return $this->partesInvolucradas
            ->where('tipo_id', ParteTipo::DEMANDADO)
            ->map(fn($parte) => $parte->modelable)
            ->values();
    }

    public function victimas()
    {
        return $this->partesInvolucradas
            ->where('tipo_id', ParteTipo::VICTIMA)
            ->map(fn($parte) => $parte->modelable)
            ->values();
    }

    public function victimarios()
    {
        return $this->partesInvolucradas
            ->where('tipo_id', ParteTipo::VICTIMARIO)
            ->map(fn($parte) => $parte->modelable)
            ->values();
    }

    public function guardarEnBitacora($mensaje)
    {
        $this->bitacoras()
            ->create([
            'usuario_id' => auth()->user()->id,
            'descripcion' => $mensaje,
        ]);
    }

    private function syncPersonas(Caso $caso, int $tipoParte, array $personas)
    {
        $nuevasClaves = collect($personas)->map(fn($p) => $p['model_type'] . '|' . $p['id'])->toArray();

        $personasActuales = ParteInvolucradaCasos::where('caso_id', $caso->id)
            ->where('tipo_id', $tipoParte)
            ->get();

        $clavesActuales = $personasActuales->map(fn($p) => $p->model_type . '|' . $p->model_id)->toArray();

        foreach ($personasActuales as $persona) {
            $clave = $persona->model_type . '|' . $persona->model_id;
            if (!in_array($clave, $nuevasClaves)) {
                $persona->delete();
            }
        }

        foreach ($personas as $persona) {
            $clave = $persona['model_type'] . '|' . $persona['id'];
            if (!in_array($clave, $clavesActuales)) {
                ParteInvolucradaCasos::create([
                    'caso_id' => $caso->id,
                    'model_type' => $persona['model_type'],
                    'model_id' => $persona['id'],
                    'tipo_id' => $tipoParte,
                ]);
            }
        }
    }


}
