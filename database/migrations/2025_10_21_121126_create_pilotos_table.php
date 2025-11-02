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
        Schema::create('pilotos', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('nombre');
            $table->integer('altura')->nullable();
            $table->string('anio_nacimiento')->nullable();
            $table->string('genero')->nullable();
            $table->string('imagen')->nullable();
            $table->timestamps();
        });
    }

    /*

-- -- Tabla `pilotos`

-- CREATE TABLE `pilotos` (
--   `id` INT NOT NULL AUTO_INCREMENT,
--   `nombre` VARCHAR(100) NOT NULL,
--   `altura` INT  NULL,
--   `anio_nacimiento` VARCHAR(20) NULL,
--   `genero` VARCHAR(20) NULL,
--   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--   PRIMARY KEY (`id`)
-- );
    */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilotos');
    }
};
