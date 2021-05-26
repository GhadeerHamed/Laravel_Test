<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function user_can_login_with_correct_credentials_api(): void
    {
        $user = User::query()->create([
            'name' => 'name',
            'email' => 'email@email.com',
            'password' => Hash::make('password'),
        ]);

        $credentials = ['email' => 'email@email.com', 'password' => 'password'];

        $response = $this->post('api/login', $credentials);

        $response->assertJsonStructure(['token', 'user']);

        $response->assertStatus(200);

    }
}
