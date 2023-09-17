<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    private $post;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->post = Post::factory()->create([
            'title' => 'Test Post Title'
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_get_post_lists(): void
    {
        $response = $this->getJson(route('api.posts.index'))
            ->assertOk();

        $this->assertEquals(1, count($response->json()['data']['posts']));
        $this->assertEquals('Test Post Title', $response->json()['data']['posts'][0]['title']);
    }

    public function test_get_post(): void
    {
        $response = $this->getJson(route('api.posts.show', $this->post->id))
            ->assertOk()
            ->json();

        $this->assertEquals($response['data']['post']['title'], $this->post->title);
    }

    public function test_store_new_post(): void
    {
        $post = Post::factory()->make();
        $response = $this->postJson(route('api.posts.store'), [
            'title' => $post->title,
            'slug' => $post->slug,
            'body' => $post->body,
            'author_id' => $post->author_id
        ])
            ->assertCreated()
            ->json();

        $this->assertEquals($post->slug, $response['data']['post']['slug']);

        $this->assertDatabaseHas('posts', [
            'slug' => $post->slug
        ]);
    }

    public function test_store_new_post_with_empty_slug(): void
    {
        $post = Post::factory()->make();
        $response = $this->postJson(route('api.posts.store'), [
            'title' => $post->title,
            'slug' => '',
            'body' => $post->body,
            'author_id' => $post->author_id
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('slug')
            ->json();

        $this->assertContains('The slug field is required.', $response['errors']['slug']);
    }

    public function test_delete_post_by_id(): void
    {
        $this->deleteJson(
            route('api.posts.destroy', $this->post->id)
        )
            ->assertNoContent();

        $this->assertSoftDeleted('posts', [
            'id' => $this->post->id
        ]);
    }

    public function test_update_post_by_id(): void
    {
        $this->putJson(route('api.posts.update', $this->post->id), [
            'title' => 'Updated post title',
            'slug' => $this->post->slug,
            'body' => $this->post->body,
            'author_id' => $this->post->author_id,
        ])
            ->assertOk();

        $this->assertDatabaseHas('posts', [
            'id' => $this->post->id,
            'title' => 'Updated post title'
        ]);
    }
}
