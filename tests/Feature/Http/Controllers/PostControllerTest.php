<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PostController
 */
final class PostControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $posts = Post::factory()->count(3)->create();

        $response = $this->get(route('post.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PostController::class,
            'store',
            \App\Http\Requests\PostStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $title = $this->faker->sentence(4);
        $slug = $this->faker->slug();
        $author = Author::factory()->create();
        $is_published = $this->faker->boolean();

        $response = $this->post(route('post.store'), [
            'title' => $title,
            'slug' => $slug,
            'author_id' => $author->id,
            'is_published' => $is_published,
        ]);

        $posts = Post::query()
            ->where('title', $title)
            ->where('slug', $slug)
            ->where('author_id', $author->id)
            ->where('is_published', $is_published)
            ->get();
        $this->assertCount(1, $posts);
        $post = $posts->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('post.show', $post));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PostController::class,
            'update',
            \App\Http\Requests\PostUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $post = Post::factory()->create();
        $title = $this->faker->sentence(4);
        $slug = $this->faker->slug();
        $author = Author::factory()->create();
        $is_published = $this->faker->boolean();

        $response = $this->put(route('post.update', $post), [
            'title' => $title,
            'slug' => $slug,
            'author_id' => $author->id,
            'is_published' => $is_published,
        ]);

        $post->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $post->title);
        $this->assertEquals($slug, $post->slug);
        $this->assertEquals($author->id, $post->author_id);
        $this->assertEquals($is_published, $post->is_published);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $post = Post::factory()->create();

        $response = $this->delete(route('post.destroy', $post));

        $response->assertNoContent();

        $this->assertModelMissing($post);
    }
}
