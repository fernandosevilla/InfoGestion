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
        Schema::create('historial_llamadas_parte', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parte_trabajo_id')->constrained('partes_trabajo')->onDelete('cascade');
            $table->timestamp('fecha');
            $table->text('detalle')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_llamadas_parte');
    }
};
