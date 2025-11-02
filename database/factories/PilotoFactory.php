<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Piloto>
 */
class PilotoFactory extends Factory
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
            'nombre' =>$faker->randomElement(['Luke Skywalker','C-3PO','R2-D2','Darth Vader','Leia Organa','Owen Lars','Beru Whitesun lars','R5-D4','Biggs Darklighter','Obi-Wan Kenobi','jar jar binks']),
            'altura' =>rand(150,200),
            'anio_nacimiento' =>$faker->randomElement(['19BBY','33BBY','112BBY','44BBY','55BBY','66BBY','77BBY','88BBY']),
            'genero' =>$faker->randomElement(['male','female','n/a']),
            'imagen' => "http://127.0.0.1:8000/storage/perfiles/anon-user-profile.jpg"

        ];
    }
}
