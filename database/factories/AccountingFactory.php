<?php

namespace Database\Factories;

use App\Models\Accounting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accounting>
 */
class AccountingFactory extends Factory
{
    protected $model = Accounting::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'amount_received' => $this->faker->randomFloat(10,1000,10000),
            'address_received' => $this->faker->streetAddress(),
            'amount_paid' => $this->faker->randomFloat(10,1000,10000),
            'address_paid' => $this->faker->streetAddress(),
            'balance' => $this->faker->randomFloat(10,1000,10000),
        ];
    }
}
