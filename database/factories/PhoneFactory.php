<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Phone;

class PhoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Phone::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'phone' => $this->faker->phoneNumber(),
            'is_verified' => $this->faker->boolean(),
            'is_main' => $this->faker->boolean(),
        ];
    }
}
