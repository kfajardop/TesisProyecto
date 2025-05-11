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
        Schema::create('caso_penal_detalles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('no_causa', 10);
            $table->string('no_expediente', 45);
            $table->integer('caso_id')->index('fk_caso_penal_detalles_casos1_idx');
            $table->integer('delito_id')->index('fk_caso_penal_detalles_caso_penal_delitos1_idx');
            $table->integer('etapa_id')->index('fk_caso_penal_detalles_caso_penal_etapas1_idx');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caso_penal_detalles');
    }
};
