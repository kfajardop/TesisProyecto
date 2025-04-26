<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->text('descripcion')->nullable();
            $table->Integer('prioridad_id');
            $table->Integer('estado_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            // Índices
            $table->index('prioridad_id', 'fk_tareas_tarea_prioridades1_idx');
            $table->index('estado_id', 'fk_tareas_tarea_estados1_idx');

            // Llaves foráneas
            $table->foreign('prioridad_id')
                ->references('id')
                ->on('tarea_prioridades')
                ->onUpdate('no action')
                ->onDelete('no action');

            $table->foreign('estado_id')
                ->references('id')
                ->on('tarea_estados')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
