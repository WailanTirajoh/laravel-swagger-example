<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_a_user_can_login_with_email_and_password(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route("api.login"), [
            "email" => $user->email,
            "password" => "password"
        ])
            ->assertOk();

        $this->assertArrayHasKey("data", $response->json());
        $this->assertArrayHasKey("access_token", $response->json()["data"]);
    }

    /**
     * A basic feature test example.
     */
    public function test_if_user_email_is_unavailable_then_it_return_error(): void
    {
        $this->postJson(route("api.login"), [
            "email" => "wailantirajoh@gmail.com",
            "password" => "wailan"
        ])
            ->assertUnauthorized();
    }
}
