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
        Schema::table('personas_has_documentos', function (Blueprint $table) {
            $table->foreign(['documentos_id'], 'fk_personas_has_documentos_documentos1')->references(['id'])->on('documentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['personas_id'], 'fk_personas_has_documentos_personas1')->references(['id'])->on('personas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personas_has_documentos', function (Blueprint $table) {
            $table->dropForeign('fk_personas_has_documentos_documentos1');
            $table->dropForeign('fk_personas_has_documentos_personas1');
        });
    }
};
