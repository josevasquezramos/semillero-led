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
        Schema::create('grupo_docentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')
                  ->constrained('grupos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->unique(['grupo_id', 'user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_docentes');
    }
};
