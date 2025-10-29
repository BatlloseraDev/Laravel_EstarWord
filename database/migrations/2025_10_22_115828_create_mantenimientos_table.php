<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignId('idnave')->index()->references('id')->on('naves')->onUpdate('cascade')->onDelete('restrict');
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->decimal('coste')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
