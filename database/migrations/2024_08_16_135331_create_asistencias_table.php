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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_id')
                  ->constrained('registros')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('grupo_alumno_id')
                  ->constrained('grupo_alumnos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->enum('asistio', ['p', 'f', 't', 'j'])
                  ->default('p');
            $table->unique(['registro_id', 'grupo_alumno_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
