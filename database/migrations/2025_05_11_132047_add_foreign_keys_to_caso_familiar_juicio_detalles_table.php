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
        Schema::table('caso_familiar_juicio_detalles', function (Blueprint $table) {
            $table->foreign(['caso_id'], 'fk_caso_familiar_juicios_casos1')->references(['id'])->on('casos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['juicio_etapa_id'], 'fk_caso_familiar_juicios_caso_familiar_juicio_etapas1')->references(['id'])->on('caso_familiar_juicio_etapas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['tipo_juicio_id'], 'fk_caso_familiar_juicios_caso_familiar_juicio_tipos1')->references(['id'])->on('caso_familiar_juicio_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('caso_familiar_juicio_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_caso_familiar_juicios_casos1');
            $table->dropForeign('fk_caso_familiar_juicios_caso_familiar_juicio_etapas1');
            $table->dropForeign('fk_caso_familiar_juicios_caso_familiar_juicio_tipos1');
        });
    }
};
