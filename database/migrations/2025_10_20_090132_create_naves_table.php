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
        Schema::create('naves', function (Blueprint $table) {
            $table->id()->unique();

            $table->foreignId('planeta_id')->index()->references('id')->on('planetas')->onUpdate('cascade')->onDelete('restrict');

            $table->string('nombre');
            $table->string('modelo');
            $table->integer('tripulacion')->nullable();
            $table->integer('pasajeros')->nullable();
            $table->string('clase_nave')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_naves__model');
    }
};
