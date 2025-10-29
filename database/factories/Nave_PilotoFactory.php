<?php

namespace Database\Factories;

use App\Models\Nave;
use App\Models\Piloto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nave_Piloto>
 */
class Nave_PilotoFactory extends Factory
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
            'nave_id' =>$faker->randomElement(Nave::get('id')),
            'piloto_id' =>$faker->randomElement(Piloto::get('id')),
            'fecha_asociacion' =>$faker->dateTimeBetween('-20 years', 'now'),
            'fecha_fin_asociacion' =>$faker->dateTimeBetween('now', '+20 years')
        ];
    }
}
