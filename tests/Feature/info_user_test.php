<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class info_user_test extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_info_user_succes(): void
    {

        //tiene el rol necesario
        $adminUser = User::find(2);
        Sanctum::actingAs($adminUser, ['admin']);
        $response = $this->getJson('/api/info/usuarios');
        $response->assertStatus(200);

    }


    public function test_info_user_fail(): void
    {
        //no tiene el rol necesario
        $adminUser = User::find(2);
        Sanctum::actingAs($adminUser, ['user']);
        $response = $this->getJson('/api/info/usuarios');
        $response->assertStatus(401);

    }

}
