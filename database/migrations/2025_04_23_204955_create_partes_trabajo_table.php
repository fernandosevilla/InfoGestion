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
        Schema::create('partes_trabajo', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('set null');
            $table->foreignId('aviso_id')->nullable()->constrained('avisos')->onDelete('set null');
            $table->foreignId('contrato_id')->nullable()->constrained('contratos')->onDelete('set null');
            $table->foreignId('trabajador_responsable_id')->constrained('users')->onDelete('restrict');

            $table->text('solicitud');
            $table->enum('estado', [
                'Pendiente',
                'Ejecucion',
                'Finalizado'
            ])->default('Pendiente');

            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_fin')->nullable();
            $table->enum('ubicacion_finalizacion', [
                'In-situ',
                'Taller',
                'Remoto'
            ])->nullable();

            $table->string('firma_trabajador')->nullable();
            $table->string('firma_cliente')->nullable();
            $table->boolean('email_enviado')->default(false);

            $table->string('nombre_cliente_nuevo', 100)->nullable();
            $table->string('nif_cliente_nuevo', 100)->nullable();
            $table->string('direccion_cliente_nuevo', 255)->nullable();
            $table->string('telefono_cliente_nuevo', 20)->nullable();
            $table->string('email_cliente_nuevo', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partes_trabajo');
    }
};
