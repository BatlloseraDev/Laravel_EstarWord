<?php

namespace Database\Seeders;

use App\Models\Mantenimiento;
use App\Models\Nave;
use App\Models\Nave_Piloto;
use App\Models\Piloto;
use App\Models\Planeta;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Planeta::factory(10)->create();
        Nave::factory(10)->create();
        Piloto::factory(10)->create();
        Nave_Piloto::factory(10)->create();
        Mantenimiento::factory(10)->create();


        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


    }
}
