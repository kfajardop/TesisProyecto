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
        Schema::table('tareas', function (Blueprint $table) {
            $table->foreign(['estado_id'], 'fk_tareas_tarea_estados1')->references(['id'])->on('tarea_estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['prioridad_id'], 'fk_tareas_tarea_prioridades1')->references(['id'])->on('tarea_prioridades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->dropForeign('fk_tareas_tarea_estados1');
            $table->dropForeign('fk_tareas_tarea_prioridades1');
        });
    }
};
