<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('caso_familiar_juicios', function (Blueprint $table) {
            $table->foreign(['detalles_id'], 'fk_caso_familiar_juicios_caso_familiar_detalles1')->references(['id'])->on('caso_familiar_detalles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['juicio_etapas_id'], 'fk_caso_familiar_juicios_caso_familiar_juicio_etapas1')->references(['id'])->on('caso_familiar_juicio_etapas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('caso_familiar_juicios', function (Blueprint $table) {
            $table->dropForeign('fk_caso_familiar_juicios_caso_familiar_detalles1');
            $table->dropForeign('fk_caso_familiar_juicios_caso_familiar_juicio_etapas1');
        });
    }
};
