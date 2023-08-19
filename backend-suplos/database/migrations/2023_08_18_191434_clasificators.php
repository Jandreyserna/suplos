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
       
        Schema::create('clasificators', function (Blueprint $table) {
            $table->double('codigo_segmento'); // Campo de autoincremento para la clave primaria
            $table->string('nombre_segmento');
            $table->double('codigo_familia');
            $table->string('nombre_familia');
            $table->double('codigo_clase');
            $table->string('nombre_clase');
            $table->double('codigo_producto');
            $table->string('nombre_producto');
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
