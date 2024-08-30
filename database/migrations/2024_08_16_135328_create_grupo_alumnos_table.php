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
        Schema::create('grupo_alumnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')
                  ->constrained('grupos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreignId('alumno_id')
                  ->constrained('alumnos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->unique(['grupo_id', 'alumno_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_alumnos');
    }
};
