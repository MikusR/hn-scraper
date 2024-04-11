<?php

namespace Tests\Feature;

use App\Models\Link;
use Carbon\Carbon;
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
        $this->get('/articles');

        $this->assertGuest();
    }

    public function test_user_logged_in()
    {
        $user = Auth::loginUsingId(1);
        $this->actingAs($user);
        $this->get('/articles')->assertOk();
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

    public function test_link_deletion_as_guest()
    {
        $testLink = new Link();
        $testLink->title = 'test';
        $testLink->url = 'test';
        $testLink->points = 0;
        $testLink->date = Carbon::parse("2077-01-01")->toDateTimeString();
        $testLink->save();
        $response = $this->json('DELETE', '/api/v0/delete-link/'.$testLink->article_id);
        $this->assertEquals(401, $response->getStatusCode());
    }

    public function test_link_deletion_as_user()
    {
        $testLink = Link::first();
        if ($testLink->trashed()) {
            $testLink->restore();
        }
        $user = Auth::loginUsingId(1);
        $this->actingAs($user);
        $response = $this->json('DELETE', '/api/v0/delete-link/'.$testLink->article_id);

        $this->assertEquals(200, $response->getStatusCode());
        $testLink->restore();
    }
}
