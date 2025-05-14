<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departamento extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'departamentos';

    public $fillable = [
        'nombre'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:55',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];
    const ALTA_VERAPAZ = 1;
    const BAJA_VERAPAZ = 2;
    const CHIMALTENANGO = 3;
    const CHIQUIMULA = 4;
    const EL_PROGRESO = 5;
    const ESCUINTLA = 6;
    const GUATEMALA = 7;
    const HUEHUETENANGO = 8;
    const IZABAL = 9;
    const JALAPA = 10;
    const JUTIAPA = 11;
    const PETEN = 12;
    const QUETZALTENANGO = 13;
    const QUICHE = 14;
    const RETALHULEU = 15;
    const SACATEPEQUEZ = 16;
    const SAN_MARCOS = 17;
    const SANTA_ROSA = 18;
    const SOLOLA = 19;
    const SUCHITEPEQUEZ = 20;
    const TOTONICAPAN = 21;
    const ZACAPA = 22;


    public static $messages = [

    ];

    public function municipios(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Municipio::class, 'departamento_id');
    }
}
