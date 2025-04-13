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
        Schema::table('documentos', function (Blueprint $table) {
            $table->foreign(['bitacora_documento_id'], 'fk_documentos_bitacora_documentos1')->references(['id'])->on('bitacora_documentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['estado_id'], 'fk_documentos_documento_estados1')->references(['id'])->on('documento_estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['tipo_id'], 'fk_documentos_documento_tipos1')->references(['id'])->on('documento_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['usuario_id'], 'fk_documentos_usuarios1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->dropForeign('fk_documentos_bitacora_documentos1');
            $table->dropForeign('fk_documentos_documento_estados1');
            $table->dropForeign('fk_documentos_documento_tipos1');
            $table->dropForeign('fk_documentos_usuarios1');
        });
    }
};
