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
        Schema::create('tareas_parte', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parte_trabajo_id')->constrained('partes_trabajo')->onDelete('cascade');
            $table->foreignId('trabajador_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('item_inventario_id')->nullable()->constrained('items_inventario')->onDelete('set null');

            $table->unsignedInteger('duracion')->nullable(); // en minutos
            $table->text('detalle');
            $table->enum('ubicacion', [
                'In-situ',
                'Taller',
                'Remoto'
            ])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas_parte');
    }
};
