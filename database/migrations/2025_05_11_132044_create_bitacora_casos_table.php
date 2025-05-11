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
        Schema::create('bitacora_casos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('descripcion');
            $table->unsignedBigInteger('usuario_id')->index('fk_bitacora_casos_usuarios1_idx');
            $table->integer('caso_id')->index('fk_bitacora_casos_casos1_idx');
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
        Schema::dropIfExists('bitacora_casos');
    }
};
