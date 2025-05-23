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
        Schema::table('bitacora_casos', function (Blueprint $table) {
            $table->foreign(['caso_id'], 'fk_bitacora_casos_casos1')->references(['id'])->on('casos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['usuario_id'], 'fk_bitacora_casos_usuarios1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bitacora_casos', function (Blueprint $table) {
            $table->dropForeign('fk_bitacora_casos_casos1');
            $table->dropForeign('fk_bitacora_casos_usuarios1');
        });
    }
};
