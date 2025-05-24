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
        Schema::table('parte_involucrada_audiencias', function (Blueprint $table) {
            $table->foreign(['audiencia_id'], 'fk_partes_involucradas_copy1_documentos2')
                ->references(['id'])
                ->on('audiencias')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->foreign(['tipo_id'], 'fk_partes_involucradas_partes_tipo12')
                ->references(['id'])
                ->on('parte_tipos')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parte_involucrada_audiencias', function (Blueprint $table) {
            $table->dropForeign('fk_partes_involucradas_copy1_documentos2');
            $table->dropForeign('fk_partes_involucradas_partes_tipo12');
        });
    }
};
