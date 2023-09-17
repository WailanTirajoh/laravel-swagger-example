<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test register.
     */
    public function test_register(): void
    {
        $requestBody = [
            "name" => "Wailan Tirajoh",
            "email" => "wailantirajoh@gmail.com",
            "password" => "wailan",
        ];

        $this->postJson(route("api.register"), $requestBody)
            ->assertCreated();

        $this->assertDatabaseHas("users", [
            "email" => $requestBody["email"]
        ]);
    }
}
