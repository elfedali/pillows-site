<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Reservation;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'price' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->randomElement(["pending","accepted","rejected"]),
            'note' => $this->faker->text(),
        ];
    }
}
