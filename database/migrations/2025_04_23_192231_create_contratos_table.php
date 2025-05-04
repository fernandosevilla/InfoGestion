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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('servicio_id')->nullable()->constrained('servicios')->onDelete('set null');

            $table->string('nombre', 100);
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->unsignedInteger('dias_cortesia')->default(0);
            $table->boolean('control_por_horas')->default(false);
            $table->unsignedInteger('horas_contratadas')->default(0)->nullable();
            $table->unsignedBigInteger('factura_vinculada')->nullable();
            $table->integer('horas_restantes')->nullable();
            $table->boolean('control_inventario')->default(false);
            $table->boolean('baja')->default(false);
            $table->date('fecha_baja')->nullable();
            $table->text('observaciones_baja')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
