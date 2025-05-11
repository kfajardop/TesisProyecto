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
        Schema::table('parte_involucrada_documentos', function (Blueprint $table) {
            $table->foreign(['documento_id'], 'fk_partes_involucradas_copy1_documentos1')->references(['id'])->on('documentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['tipo_id'], 'fk_partes_involucradas_partes_tipo10')->references(['id'])->on('parte_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parte_involucrada_documentos', function (Blueprint $table) {
            $table->dropForeign('fk_partes_involucradas_copy1_documentos1');
            $table->dropForeign('fk_partes_involucradas_partes_tipo10');
        });
    }
};
