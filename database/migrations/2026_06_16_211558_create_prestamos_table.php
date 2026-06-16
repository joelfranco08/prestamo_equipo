<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::create('prestamos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('equipo_id')->constrained('equipos')->onDelete('restrict');
        $table->foreignId('solicitante_id')->constrained('solicitantes')->onDelete('restrict');

        $table->date('fecha_prestamo');
        $table->date('fecha_devolucion_esperada');
        $table->date('fecha_devolucion_real')->nullable();

        // MEJORA: Control de estado del hardware
        $table->text('observaciones_entrega')->nullable();
        $table->text('observaciones_devolucion')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
