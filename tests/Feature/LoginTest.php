<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_valid_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'customer1@email.com',
            'password' => 'password',
        ]);

        //return 200 on valid login
        $response->assertStatus(200);
    }

    public function test_login_invalid_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'customer1@email.com',
            'password' => 'wrong_password',
        ]);

        //return 401 on invalid login
        $response->assertStatus(401);
    }
}
