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
        Schema::create('avisos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('set null');
            $table->foreignId('trabajador_atiende_id')->nullable()->constrained('users')->onDelete('set null');

            $table->text('detalle');
            $table->timestamp('fecha_creacion');
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
        Schema::dropIfExists('avisos');
    }
};
