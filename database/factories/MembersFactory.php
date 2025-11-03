<?php

namespace Database\Factories;

use App\Models\Members;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Members>
 */
class MembersFactory extends Factory
{
    protected $model = Members::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),  // Optionally customize with Kurdish names
            'address' => $this->faker->address(),  // You can also create a Kurdish address set if needed
            'birth_date' => $this->faker->date(),
            'gender' => $this->faker->name(),  // Kurdish for 'male' and 'female'
            'education' => $this->faker->randomElement(['فەرهادەکەی', 'مامۆستا', 'دکتۆر', 'مەندوب']),  // Kurdish educational titles: 'Bachelor', 'Teacher', 'Doctor', 'Representative'
            'work' => $this->faker->randomElement(['کارمند', 'خوێندکار', 'بازرگان', 'مامۆستا']),  // Kurdish job titles: 'Employee', 'Student', 'Trader', 'Teacher'
            'join_date' => $this->faker->date(),
        ];
    }
}
