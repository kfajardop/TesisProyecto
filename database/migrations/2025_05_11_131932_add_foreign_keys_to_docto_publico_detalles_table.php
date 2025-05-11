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
        Schema::table('docto_publico_detalles', function (Blueprint $table) {
            $table->foreign(['escritura_id'], 'fk_docto_publico_detalles_docto_publico_escrituras1')->references(['id'])->on('docto_publico_escrituras')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['documento_id'], 'fk_docto_publico_detalles_documentos1')->references(['id'])->on('documentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('docto_publico_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_docto_publico_detalles_docto_publico_escrituras1');
            $table->dropForeign('fk_docto_publico_detalles_documentos1');
        });
    }
};
