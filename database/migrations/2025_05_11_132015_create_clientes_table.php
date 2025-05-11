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
        Schema::create('clientes', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('primer_nombre', 55);
            $table->string('segundo_nombre', 55)->nullable();
            $table->string('primer_apellido', 55);
            $table->string('segundo_apellido', 55)->nullable();
            $table->string('dpi', 13)->nullable();
            $table->string('telefono', 8)->nullable();
            $table->integer('direccion_id')->index('fk_cllientes_direcciones1_idx');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
