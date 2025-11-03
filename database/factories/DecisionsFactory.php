<?php

namespace Database\Factories;

use App\Models\Decisions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Decisions>
 */
class DecisionsFactory extends Factory
{
    protected $model = Decisions::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),  
            'date' => $this->faker->date(),
            'address' => $this->faker->streetAddress(),
            'paragraph' => $this->faker->paragraph(),
        ];
    }
}
