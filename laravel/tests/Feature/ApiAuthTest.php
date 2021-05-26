<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function user_can_login_with_correct_credentials_api(): void
    {
        User::query()->create([
            'name' => 'name',
            'email' => 'email@email.com',
            'password' => Hash::make('password'),
        ]);

        $credentials = ['email' => 'email@email.com', 'password' => 'password'];

        $response = $this->post('api/login', $credentials);

        $response->assertJsonStructure(['token', 'user']);

        $response->assertStatus(200);

    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function user_cant_login_with_incorrect_credentials_api(): void
    {
        User::query()->create([
            'name' => 'name',
            'email' => 'email@email.com',
            'password' => Hash::make('password'),
        ]);

        $credentials = ['email' => 'email@email.com', 'password' => 'incorrect-password'];

        $response = $this->post('api/login', $credentials);

        $response->assertJson(['error' => 'Invalid Credentials']);

        $response->assertStatus(401);

    }
}
