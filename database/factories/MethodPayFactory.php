<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\MethodPay;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MethodPayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MethodPay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type'=>$type=$this->faker->randomElement([MethodPay::ACH,MethodPay::NOACH])
            ,'description'=>$this->faker->paragraph(2),
            'delivery_address'=>$this->faker->address,
            'date_come'=>$this->faker->date('Y-m-d')
        ];
    }
}
