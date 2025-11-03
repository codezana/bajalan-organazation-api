<?php

namespace Database\Factories;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    protected $model = Equipment::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['کۆمپیوتەر', 'پرینتەر', 'شاشە']),  // Kurdish equipment names
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(3, 50, 1000),
            'total' => $this->faker->randomFloat(3, 500, 5000),
        ];
    }
}
