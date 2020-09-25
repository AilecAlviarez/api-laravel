<?php

namespace Database\Factories;

use App\Models\Deliveries;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Deliveries::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'delivery_address'=>$this->faker->address
            ,'date_come'=>$this->faker->date('Y-m-d')
        ];
    }
}
