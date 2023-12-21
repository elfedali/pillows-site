<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ImageController
 */
final class ImageControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $images = Image::factory()->count(3)->create();

        $response = $this->get(route('image.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ImageController::class,
            'store',
            \App\Http\Requests\ImageStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $path = $this->faker->word();
        $is_featured = $this->faker->boolean();

        $response = $this->post(route('image.store'), [
            'path' => $path,
            'is_featured' => $is_featured,
        ]);

        $images = Image::query()
            ->where('path', $path)
            ->where('is_featured', $is_featured)
            ->get();
        $this->assertCount(1, $images);
        $image = $images->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $image = Image::factory()->create();

        $response = $this->get(route('image.show', $image));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ImageController::class,
            'update',
            \App\Http\Requests\ImageUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $image = Image::factory()->create();
        $path = $this->faker->word();
        $is_featured = $this->faker->boolean();

        $response = $this->put(route('image.update', $image), [
            'path' => $path,
            'is_featured' => $is_featured,
        ]);

        $image->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($path, $image->path);
        $this->assertEquals($is_featured, $image->is_featured);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $image = Image::factory()->create();

        $response = $this->delete(route('image.destroy', $image));

        $response->assertNoContent();

        $this->assertModelMissing($image);
    }
}
