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
        Schema::create('documentos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('tipo_id')->index('fk_documentos_documento_tipos1_idx');
            $table->integer('estado_id')->index('fk_documentos_documento_estados1_idx');
            $table->unsignedBigInteger('usuario_id')->index('fk_documentos_usuarios1_idx');
            $table->integer('bitacora_documento_id')->index('fk_documentos_bitacora_documentos1_idx');
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
        Schema::dropIfExists('documentos');
    }
};
