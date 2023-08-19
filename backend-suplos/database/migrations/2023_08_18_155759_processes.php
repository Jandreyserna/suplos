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
        Schema::create('processes', function (Blueprint $table) {
            $table->id(); // Campo de autoincremento para la clave primaria
            $table->string('object');
            $table->string('description');
            $table->string('money');
            $table->string('budget');
            $table->string('activity');
            $table->date('init_date');
            $table->time('init_hour');
            $table->date('finish_date');
            $table->time('finish_hour');
            $table->string('state');
            $table->timestamps(); // Campos para el control de fecha y hora de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
