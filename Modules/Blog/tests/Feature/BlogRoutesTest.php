<?php

namespace Modules\Blog\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class BlogRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_access_blog_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/blogs');

        $response->assertStatus(200);
    }

    public function test_guest_user_cannot_access_blog_index()
    {
        $response = $this->get('/blogs');

        $response->assertRedirect('/login');
    }
}
