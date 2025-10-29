<?php

namespace Database\Factories;

use App\Models\Nave;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mantenimiento>
 */
class MantenimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker =  FakerFactory::create('es_ES');

        return [
            'idnave' =>$faker->randomElement(Nave::get('id')),
            'fecha' =>$faker->dateTimeBetween('-20 years', 'now'),
            'descripcion' =>$faker->paragraph(),
            'coste' =>rand(1000,100000)
        ];
    }
}
