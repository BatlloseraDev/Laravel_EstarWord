<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planeta>
 */
class PlanetaFactory extends Factory
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
            'nombre'=>$faker->randomElement(['Tatooine','Alderaan','Yavin IV','Hoth','Dagobah','Bespin','Endor','Naboo','Coruscant','Kamino']),
            'periodo_rotacion'=>$faker->randomElement(['23','26','24','20','5']),
            'poblacion'=>$faker->randomElement(['200000','4500000000','1000000000','12000000','100000']),
            'clima' =>$faker->randomElement(['arido','templado','tropical','frio','humedo'])
        ];
    }
}
