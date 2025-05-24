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
        Schema::create('parte_involucrada_audiencias', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('model_type');
            $table->integer('model_id');
            $table->integer('tipo_id')->index('fk_partes_involucradas_partes_tipo2_idx');
            $table->integer('audiencia_id')->index('fk_partes_involucradas_copy1_documentos2_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parte_involucrada_audiencias');
    }
};
