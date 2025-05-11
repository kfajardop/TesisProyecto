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
        Schema::create('personas_has_documentos', function (Blueprint $table) {
            $table->integer('personas_id')->index('fk_personas_has_documentos_personas1_idx');
            $table->integer('documentos_id')->index('fk_personas_has_documentos_documentos1_idx');

            $table->primary(['personas_id', 'documentos_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas_has_documentos');
    }
};
