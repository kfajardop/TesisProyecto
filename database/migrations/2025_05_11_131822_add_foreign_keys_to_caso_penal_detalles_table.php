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
        Schema::table('caso_penal_detalles', function (Blueprint $table) {
            $table->foreign(['caso_id'], 'fk_caso_penal_detalles_casos1')->references(['id'])->on('casos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['delito_id'], 'fk_caso_penal_detalles_caso_penal_delitos1')->references(['id'])->on('caso_penal_delitos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['etapa_id'], 'fk_caso_penal_detalles_caso_penal_etapas1')->references(['id'])->on('caso_penal_etapas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('caso_penal_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_caso_penal_detalles_casos1');
            $table->dropForeign('fk_caso_penal_detalles_caso_penal_delitos1');
            $table->dropForeign('fk_caso_penal_detalles_caso_penal_etapas1');
        });
    }
};
