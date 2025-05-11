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
        Schema::table('casos', function (Blueprint $table) {
            $table->foreign(['estado_id'], 'fk_casos_caso_estados1')->references(['id'])->on('caso_estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['tipo_id'], 'fk_casos_tipos_casos1')->references(['id'])->on('caso_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['usuario_id'], 'fk_casos_usuarios1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('casos', function (Blueprint $table) {
            $table->dropForeign('fk_casos_caso_estados1');
            $table->dropForeign('fk_casos_tipos_casos1');
            $table->dropForeign('fk_casos_usuarios1');
        });
    }
};
