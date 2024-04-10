<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_not_logged_in()
    {
        $this->get('/app');

        $this->assertGuest();
    }

    public function test_user_logged_in()
    {
        $user = Auth::loginUsingId(1);
        $this->actingAs($user);
        $this->get('/app')->assertOk();
    }

    public function test_access_to_api_as_user()
    {
        $user = Auth::loginUsingId(1);
        $this->actingAs($user);
        $this->getJson('/api/v0/index')->assertOk();
    }

    public function test_access_to_api_while_unauthentificated()
    {
        $this->getJson('/api/v0/index')->assertUnauthorized();
    }
}
