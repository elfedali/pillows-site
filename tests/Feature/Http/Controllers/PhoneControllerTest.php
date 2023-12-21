<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Phone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PhoneController
 */
final class PhoneControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $phones = Phone::factory()->count(3)->create();

        $response = $this->get(route('phone.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PhoneController::class,
            'store',
            \App\Http\Requests\PhoneStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $phone = $this->faker->phoneNumber();

        $response = $this->post(route('phone.store'), [
            'phone' => $phone,
        ]);

        $phones = Phone::query()
            ->where('phone', $phone)
            ->get();
        $this->assertCount(1, $phones);
        $phone = $phones->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $phone = Phone::factory()->create();

        $response = $this->get(route('phone.show', $phone));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PhoneController::class,
            'update',
            \App\Http\Requests\PhoneUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $phone = Phone::factory()->create();
        $phone = $this->faker->phoneNumber();

        $response = $this->put(route('phone.update', $phone), [
            'phone' => $phone,
        ]);

        $phone->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($phone, $phone->phone);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $phone = Phone::factory()->create();

        $response = $this->delete(route('phone.destroy', $phone));

        $response->assertNoContent();

        $this->assertModelMissing($phone);
    }
}
