<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Owner;
use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PlaceController
 */
final class PlaceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $places = Place::factory()->count(3)->create();

        $response = $this->get(route('place.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PlaceController::class,
            'store',
            \App\Http\Requests\PlaceStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $owner = Owner::factory()->create();
        $name = $this->faker->name();
        $slug = $this->faker->slug();
        $description = $this->faker->text();
        $is_approved = $this->faker->boolean();
        $is_active = $this->faker->boolean();
        $longitude = $this->faker->longitude();
        $latitude = $this->faker->latitude();
        $max_guests = $this->faker->numberBetween(-10000, 10000);
        $num_bedrooms = $this->faker->numberBetween(-10000, 10000);
        $num_beds = $this->faker->numberBetween(-10000, 10000);
        $num_baths = $this->faker->numberBetween(-10000, 10000);
        $superficy = $this->faker->numberBetween(-10000, 10000);
        $check_in_hour = $this->faker->numberBetween(-10000, 10000);
        $check_out_hour = $this->faker->numberBetween(-10000, 10000);
        $cancellation_policy = $this->faker->word();
        $min_stay = $this->faker->numberBetween(-10000, 10000);
        $max_stay = $this->faker->numberBetween(-10000, 10000);
        $price = $this->faker->numberBetween(-10000, 10000);
        $currency = $this->faker->word();

        $response = $this->post(route('place.store'), [
            'owner_id' => $owner->id,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'is_approved' => $is_approved,
            'is_active' => $is_active,
            'longitude' => $longitude,
            'latitude' => $latitude,
            'max_guests' => $max_guests,
            'num_bedrooms' => $num_bedrooms,
            'num_beds' => $num_beds,
            'num_baths' => $num_baths,
            'superficy' => $superficy,
            'check_in_hour' => $check_in_hour,
            'check_out_hour' => $check_out_hour,
            'cancellation_policy' => $cancellation_policy,
            'min_stay' => $min_stay,
            'max_stay' => $max_stay,
            'price' => $price,
            'currency' => $currency,
        ]);

        $places = Place::query()
            ->where('owner_id', $owner->id)
            ->where('name', $name)
            ->where('slug', $slug)
            ->where('description', $description)
            ->where('is_approved', $is_approved)
            ->where('is_active', $is_active)
            ->where('longitude', $longitude)
            ->where('latitude', $latitude)
            ->where('max_guests', $max_guests)
            ->where('num_bedrooms', $num_bedrooms)
            ->where('num_beds', $num_beds)
            ->where('num_baths', $num_baths)
            ->where('superficy', $superficy)
            ->where('check_in_hour', $check_in_hour)
            ->where('check_out_hour', $check_out_hour)
            ->where('cancellation_policy', $cancellation_policy)
            ->where('min_stay', $min_stay)
            ->where('max_stay', $max_stay)
            ->where('price', $price)
            ->where('currency', $currency)
            ->get();
        $this->assertCount(1, $places);
        $place = $places->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $place = Place::factory()->create();

        $response = $this->get(route('place.show', $place));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PlaceController::class,
            'update',
            \App\Http\Requests\PlaceUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $place = Place::factory()->create();
        $owner = Owner::factory()->create();
        $name = $this->faker->name();
        $slug = $this->faker->slug();
        $description = $this->faker->text();
        $is_approved = $this->faker->boolean();
        $is_active = $this->faker->boolean();
        $longitude = $this->faker->longitude();
        $latitude = $this->faker->latitude();
        $max_guests = $this->faker->numberBetween(-10000, 10000);
        $num_bedrooms = $this->faker->numberBetween(-10000, 10000);
        $num_beds = $this->faker->numberBetween(-10000, 10000);
        $num_baths = $this->faker->numberBetween(-10000, 10000);
        $superficy = $this->faker->numberBetween(-10000, 10000);
        $check_in_hour = $this->faker->numberBetween(-10000, 10000);
        $check_out_hour = $this->faker->numberBetween(-10000, 10000);
        $cancellation_policy = $this->faker->word();
        $min_stay = $this->faker->numberBetween(-10000, 10000);
        $max_stay = $this->faker->numberBetween(-10000, 10000);
        $price = $this->faker->numberBetween(-10000, 10000);
        $currency = $this->faker->word();

        $response = $this->put(route('place.update', $place), [
            'owner_id' => $owner->id,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'is_approved' => $is_approved,
            'is_active' => $is_active,
            'longitude' => $longitude,
            'latitude' => $latitude,
            'max_guests' => $max_guests,
            'num_bedrooms' => $num_bedrooms,
            'num_beds' => $num_beds,
            'num_baths' => $num_baths,
            'superficy' => $superficy,
            'check_in_hour' => $check_in_hour,
            'check_out_hour' => $check_out_hour,
            'cancellation_policy' => $cancellation_policy,
            'min_stay' => $min_stay,
            'max_stay' => $max_stay,
            'price' => $price,
            'currency' => $currency,
        ]);

        $place->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($owner->id, $place->owner_id);
        $this->assertEquals($name, $place->name);
        $this->assertEquals($slug, $place->slug);
        $this->assertEquals($description, $place->description);
        $this->assertEquals($is_approved, $place->is_approved);
        $this->assertEquals($is_active, $place->is_active);
        $this->assertEquals($longitude, $place->longitude);
        $this->assertEquals($latitude, $place->latitude);
        $this->assertEquals($max_guests, $place->max_guests);
        $this->assertEquals($num_bedrooms, $place->num_bedrooms);
        $this->assertEquals($num_beds, $place->num_beds);
        $this->assertEquals($num_baths, $place->num_baths);
        $this->assertEquals($superficy, $place->superficy);
        $this->assertEquals($check_in_hour, $place->check_in_hour);
        $this->assertEquals($check_out_hour, $place->check_out_hour);
        $this->assertEquals($cancellation_policy, $place->cancellation_policy);
        $this->assertEquals($min_stay, $place->min_stay);
        $this->assertEquals($max_stay, $place->max_stay);
        $this->assertEquals($price, $place->price);
        $this->assertEquals($currency, $place->currency);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $place = Place::factory()->create();

        $response = $this->delete(route('place.destroy', $place));

        $response->assertNoContent();

        $this->assertModelMissing($place);
    }
}
