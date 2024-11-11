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
        Schema::table('reservations', function (Blueprint $table) {
            // Agregar columna para la hora de fin de la reserva
            $table->time('reservation_end_time')->nullable(); // Se puede dejar como nullable si no siempre se tiene la hora de fin al crear la reserva
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Eliminar la columna si se revierte la migración
            $table->dropColumn('reservation_end_time');
        });
    }
};