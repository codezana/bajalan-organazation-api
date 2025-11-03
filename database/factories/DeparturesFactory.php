<?php

namespace Database\Factories;

use App\Models\Departures;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departures>
 */
class DeparturesFactory extends Factory
{
    protected $model = Departures::class;

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
