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
        Schema::table('bitacora_documentos', function (Blueprint $table) {
            $table->foreign(['usuario_id'], 'fk_bitacora_documentos_usuarios1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bitacora_documentos', function (Blueprint $table) {
            $table->dropForeign('fk_bitacora_documentos_usuarios1');
        });
    }
};
