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
        Schema::create('caso_familiar_juicios', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre');
            $table->integer('detalles_id')->index('fk_caso_familiar_juicios_caso_familiar_detalles1_idx');
            $table->integer('juicio_etapas_id')->index('fk_caso_familiar_juicios_caso_familiar_juicio_etapas1_idx');
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
        Schema::dropIfExists('caso_familiar_juicios');
    }
};
