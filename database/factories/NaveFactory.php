<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use App\Models\Planeta;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nave>
 */
class NaveFactory extends Factory
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
            'nombre' =>$faker->randomElement(['CR90 corvette','Star Destroyer','Sentinel-class landing craft','Death Star','Millennium Falcon','Y-wing','X-wing','TIE Advanced x1','Executor']),
            'modelo' =>$faker->randomElement(['Imperial I-class Star Destroyer','Imperial II-class Star Destroyer','Sentinel-class landing craft','CR90 corvette']),
            'tripulacion' =>rand(5,1000),
            'pasajeros' =>rand(5,1000),
            'clase_nave' =>$faker->randomElement(['corvette','Deep Space Mobile Battlestation','Star Destroyer','landing craft','Light freighter','assault starfighter','Starfighter','Star dreadnought']),
            'planeta_id' =>$faker->randomElement(Planeta::get('id')),
        ];
    }
}
