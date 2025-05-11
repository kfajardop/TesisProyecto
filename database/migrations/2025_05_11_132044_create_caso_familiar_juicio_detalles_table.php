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
        Schema::create('caso_familiar_juicio_detalles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre')->nullable();
            $table->integer('juicio_etapa_id')->index('fk_caso_familiar_juicios_caso_familiar_juicio_etapas1_idx');
            $table->integer('caso_id')->index('fk_caso_familiar_juicios_casos1_idx');
            $table->integer('tipo_juicio_id')->index('fk_caso_familiar_juicios_caso_familiar_juicio_tipos1_idx');
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
        Schema::dropIfExists('caso_familiar_juicio_detalles');
    }
};
