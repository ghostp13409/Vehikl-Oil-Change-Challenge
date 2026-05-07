<?php

namespace Database\Factories;

use App\Models\OilChangeCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OilChangeCheck>
 */
class OilChangeCheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'current_odometer' => $this->faker->numberBetween(0, 20000),
            'previous_oil_change_date' => $this->faker->date(),
            'previous_oil_change_odometer' => $this->faker->numberBetween(0, 20000),
            'is_due' => $this->faker->boolean(),
        ];
    }
}
