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
        Schema::create('planetas', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('nombre');
            $table->string('periodo_rotacion')->nullable();
            $table->bigInteger('poblacion')->nullable();
            $table->string('clima')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_planetas__model');
    }
};
/*
-- CREATE TABLE  `planetas` (
--   `id` INT  NOT NULL AUTO_INCREMENT,
--   `nombre` VARCHAR(100) NOT NULL,
--   `periodo_rotacion` VARCHAR(50) NULL,
--   `poblacion` BIGINT NULL,
--   `clima` VARCHAR(100) NULL,
--   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--   PRIMARY KEY (`id`)
-- );

*/
