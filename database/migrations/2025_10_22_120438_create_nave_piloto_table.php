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
        Schema::create('nave_piloto', function (Blueprint $table) {
            $table->foreignId('nave_id')->index()->references('id')->on('naves')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('piloto_id')->index()->references('id')->on('pilotos')->onUpdate('cascade')->onDelete('cascade');
            $table->date('fecha_asociacion');
            $table->date('fecha_fin_asociacion')->nullable();
            $table->timestamps();
            $table->primary(['nave_id', 'piloto_id', 'fecha_asociacion']);
        });
    }

    /*
    --   `nave_id` INT  NOT NULL,
--   `piloto_id` INT  NOT NULL,
--   `fecha_asociacion` DATE NOT NULL,
--   `fecha_fin_asociacion` DATE NULL, -- Puede ser NULL si el piloto sigue asociado
--   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,


--   PRIMARY KEY (`nave_id`, `piloto_id`, `fecha_asociacion`),

--   CONSTRAINT `fk_np_naves` FOREIGN KEY (`nave_id`) REFERENCES `naves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
--   CONSTRAINT `fk_np_pilotos` FOREIGN KEY (`piloto_id`) REFERENCES `pilotos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE


    */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nave_piloto');
    }
};
