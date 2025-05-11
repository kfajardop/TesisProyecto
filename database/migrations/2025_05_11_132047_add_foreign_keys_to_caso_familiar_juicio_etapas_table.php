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
        Schema::table('caso_familiar_juicio_etapas', function (Blueprint $table) {
            $table->foreign(['tipo_juicio_id'], 'fk_caso_familiar_juicio_etapas_caso_familiar_juicio_tipos1')->references(['id'])->on('caso_familiar_juicio_tipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('caso_familiar_juicio_etapas', function (Blueprint $table) {
            $table->dropForeign('fk_caso_familiar_juicio_etapas_caso_familiar_juicio_tipos1');
        });
    }
};
