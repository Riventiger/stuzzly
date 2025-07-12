<?php

namespace Modules\Blog\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Blog\Models\Post;
use App\Models\User;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_blog_routes()
    {
        $response = $this->get(route('blog.index'));
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_blog_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('blog.index'));
        $response->assertStatus(200);
        $response->assertViewIs('blog::index');
    }

    public function test_authenticated_user_can_create_post()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('blog.store'), [
            'title' => 'Test Title',
            'content' => 'Test content',
            'is_published' => true,
        ]);

        $response->assertRedirect(route('blog.index'));
        $this->assertDatabaseHas('blog_posts', ['title' => 'Test Title']);
    }
}
