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
        Schema::table('docto_acta_detalles', function (Blueprint $table) {
            $table->foreign(['notarial_id'], 'fk_docto_acta_detalles_docto_acta_tipos1')->references(['id'])->on('docto_acta_notariales')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['documento_id'], 'fk_docto_acta_detalles_documentos1')->references(['id'])->on('documentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('docto_acta_detalles', function (Blueprint $table) {
            $table->dropForeign('fk_docto_acta_detalles_docto_acta_tipos1');
            $table->dropForeign('fk_docto_acta_detalles_documentos1');
        });
    }
};
