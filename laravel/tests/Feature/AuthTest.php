<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function user_can_access_login_endpoint_web(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function user_can_login_with_correct_credentials(): void
    {
        $user = User::query()->create([
            'name' => 'name',
            'email' => 'email@email.com',
            'password' => Hash::make('password'),
        ]);
        $credentials = ['email' => 'email@email.com', 'password' => 'password'];
        Auth::attempt($credentials);

        $this->assertAuthenticated();
    }
}
