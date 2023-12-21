<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Place;
use App\Models\User;

class PlaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Place::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'owner_id' => User::factory(),
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'slogan' => $this->faker->word(),
            'description' => $this->faker->text(),
            'is_approved' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'website' => $this->faker->word(),
            'address' => $this->faker->word(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'zip_code' => $this->faker->word(),
            'max_guests' => $this->faker->numberBetween(-10000, 10000),
            'num_bedrooms' => $this->faker->numberBetween(-10000, 10000),
            'num_beds' => $this->faker->numberBetween(-10000, 10000),
            'num_baths' => $this->faker->numberBetween(-10000, 10000),
            'superficy' => $this->faker->numberBetween(-10000, 10000),
            'check_in_hour' => $this->faker->numberBetween(-10000, 10000),
            'check_out_hour' => $this->faker->numberBetween(-10000, 10000),
            'cancellation_policy' => $this->faker->word(),
            'min_stay' => $this->faker->numberBetween(-10000, 10000),
            'max_stay' => $this->faker->numberBetween(-10000, 10000),
            'price' => $this->faker->numberBetween(-10000, 10000),
            'currency' => $this->faker->word(),
        ];
    }
}
