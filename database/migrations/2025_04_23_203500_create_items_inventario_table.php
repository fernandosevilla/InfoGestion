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
        Schema::create('items_inventario', function (Blueprint $table) {
            $table->id();

            $table->foreignId('inventario_id')->constrained('inventarios')->onDelete('cascade');
            $table->foreignId('contrato_id')->nullable()->constrained('contratos')->onDelete('set null');

            $table->string('nombre', 100);
            $table->enum('tipo', [
                'Hardware red',
                'Hardware sistemas',
                'Software',
                'Ciberseguridad',
                'Impresion',
                'Hosteleria'
            ]);

            $table->string('num_serie', 100)->nullable();
            $table->string('marca', 100)->nullable();
            $table->string('modelo', 100)->nullable();
            $table->datetime('fecha_compra')->nullable();
            $table->date('fecha_fin_garantia')->nullable();
            $table->string('foto', 255)->nullable(); // ruta de la foto (storage/public?)
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_inventario');
    }
};
