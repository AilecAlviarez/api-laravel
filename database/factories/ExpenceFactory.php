<?php

namespace Database\Factories;

use App\Models\Buyer;
use App\Models\Expence;
use App\Models\MethodPay;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExpenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expence::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>User::all()->where('role','==','0')->random()->user_id,
            'status_id'=>Status::all()->random()->status_id,
            'total'=>$this->faker->randomFloat(1,10,20000),
            'method_pay_id'=>MethodPay::all()->random()->method_pay_id
        ];
    }
}
