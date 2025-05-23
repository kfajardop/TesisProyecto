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
        Schema::table('docto_privado_detalles', function (Blueprint $table) {
            $table->foreign(['contrato_id'], 'fk_docto_privado_detalles_docto_privado_contratos1')->references(['id'])->on('docto_privado_contratos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['documento_id'], 'fk_docto_privado_detalles_documentos1')->references(['id'])->on('documentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('docto_privado_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_docto_privado_detalles_docto_privado_contratos1');
            $table->dropForeign('fk_docto_privado_detalles_documentos1');
        });
    }
};
