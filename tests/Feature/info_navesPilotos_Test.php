<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class info_navesPilotos_Test extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_navePiloto_info(): void
    {
        $fak = \Faker\Factory::create('es_ES');

        $datosPiloto = [
            'nombre' => $fak->randomElement(['Luke Skywalker', 'C-3PO', 'R2-D2', 'Darth Vader', 'Leia Organa', 'Owen Lars', 'Beru Whitesun lars', 'R5-D4', 'Biggs Darklighter', 'Obi-Wan Kenobi', 'jar jar binks']),
            'altura' => rand(150, 200),
            'anio_nacimiento' => $fak->randomElement(['19BBY', '33BBY', '112BBY', '44BBY', '55BBY', '66BBY', '77BBY', '88BBY']),
            'genero' => $fak->randomElement(['male', 'female', 'n/a']),
            'imagen' => "http://127.0.0.1:8000/storage/perfiles/anon-user-profile.jpg"
        ];
        $response = $this->postJson('/api/pilotos', $datosPiloto);
        $response->assertStatus(200);

        $datosNave = [
            'nombre' => $fak->randomElement(['CR90 corvette', 'Star Destroyer', 'Sentinel-class landing craft', 'Death Star', 'Millennium Falcon', 'Y-wing', 'X-wing', 'TIE Advanced x1', 'Executor']),
            'modelo' => $fak->randomElement(['Imperial I-class Star Destroyer', 'Imperial II-class Star Destroyer', 'Sentinel-class landing craft', 'CR90 corvette']),
            'tripulacion' => rand(5, 1000),
            'pasajeros' => rand(5, 1000),
            'clase_nave' => $fak->randomElement(['corvette', 'Deep Space Mobile Battlestation', 'Star Destroyer', 'landing craft', 'Light freighter', 'assault starfighter', 'Starfighter', 'Star dreadnought']),
            'planeta_id' => 1,
        ];
        $response = $this->postJson('/api/naves', $datosNave);
        $response->assertStatus(200);

        $response = $this->getJson('/api/info/navesPilotos');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'navesPilotos' => [
                '*' => [
                    "nave_id",
                    "piloto_id",
                    "fecha_asociacion",
                    "fecha_fin_asociacion",
                    "nave" => [
                        "id",
                        "planeta_id",
                        "nombre",
                        "modelo",
                        "tripulacion",
                        "pasajeros",
                        "clase_nave",
                        "planeta" => [
                            "id",
                            "nombre",
                            "periodo_rotacion",
                            "poblacion",
                            "clima",
                            "created_at",
                            "updated_at"
                        ]
                    ],
                    "piloto" => [
                        "id",
                        "nombre",
                        "altura",
                        "anio_nacimiento",
                        "genero",
                        "imagen",
                        "created_at",
                        "updated_at"
                    ]
                ]
            ]
        ]);



        //$response->assertStatus(200);
    }
}
