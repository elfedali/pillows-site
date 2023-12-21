<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FeatureController
 */
final class FeatureControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $features = Feature::factory()->count(3)->create();

        $response = $this->get(route('feature.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FeatureController::class,
            'store',
            \App\Http\Requests\FeatureStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();
        $slug = $this->faker->slug();

        $response = $this->post(route('feature.store'), [
            'name' => $name,
            'slug' => $slug,
        ]);

        $features = Feature::query()
            ->where('name', $name)
            ->where('slug', $slug)
            ->get();
        $this->assertCount(1, $features);
        $feature = $features->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $feature = Feature::factory()->create();

        $response = $this->get(route('feature.show', $feature));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FeatureController::class,
            'update',
            \App\Http\Requests\FeatureUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $feature = Feature::factory()->create();
        $name = $this->faker->name();
        $slug = $this->faker->slug();

        $response = $this->put(route('feature.update', $feature), [
            'name' => $name,
            'slug' => $slug,
        ]);

        $feature->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $feature->name);
        $this->assertEquals($slug, $feature->slug);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $feature = Feature::factory()->create();

        $response = $this->delete(route('feature.destroy', $feature));

        $response->assertNoContent();

        $this->assertModelMissing($feature);
    }
}
