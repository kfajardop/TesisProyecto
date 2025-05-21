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
        Schema::create('bitacora_documentos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('titulo',255);
            $table->string('descripcion');
            $table->unsignedBigInteger('usuario_id')
                ->index('fk_bitacora_documentos_usuarios1_idx');
            $table->integer('documento_id')
                ->index('fk_bitacora_documentos_documentos1_idx');
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
        Schema::dropIfExists('bitacora_documentos');
    }
};
