<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\MethodPay;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bank::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bank_name'=>$this->faker->name,
            'method_pay_id'=>MethodPay::all()->where('type','==',MethodPay::ACH)
        ];
    }
}
