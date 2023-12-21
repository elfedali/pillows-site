<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReservationController
 */
final class ReservationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $reservations = Reservation::factory()->count(3)->create();

        $response = $this->get(route('reservation.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReservationController::class,
            'store',
            \App\Http\Requests\ReservationStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $start_date = $this->faker->date();
        $end_date = $this->faker->date();
        $price = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('reservation.store'), [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'price' => $price,
            'status' => $status,
        ]);

        $reservations = Reservation::query()
            ->where('start_date', $start_date)
            ->where('end_date', $end_date)
            ->where('price', $price)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $reservations);
        $reservation = $reservations->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->get(route('reservation.show', $reservation));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReservationController::class,
            'update',
            \App\Http\Requests\ReservationUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $reservation = Reservation::factory()->create();
        $start_date = $this->faker->date();
        $end_date = $this->faker->date();
        $price = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('reservation.update', $reservation), [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'price' => $price,
            'status' => $status,
        ]);

        $reservation->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals(Carbon::parse($start_date), $reservation->start_date);
        $this->assertEquals(Carbon::parse($end_date), $reservation->end_date);
        $this->assertEquals($price, $reservation->price);
        $this->assertEquals($status, $reservation->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->delete(route('reservation.destroy', $reservation));

        $response->assertNoContent();

        $this->assertModelMissing($reservation);
    }
}
