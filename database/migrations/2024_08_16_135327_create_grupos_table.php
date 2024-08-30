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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('curso_id')
                  ->constrained('cursos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreignId('grado_id')
                  ->constrained('grados')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreignId('periodo_id')
                  ->constrained('periodos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
