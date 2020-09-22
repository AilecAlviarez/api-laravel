<?php

namespace Database\Factories;

use App\Models\Detail_Income;
use App\Models\Income;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class Detail_IncomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Detail_Income::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'product_id'=>Product::all()->random()->product_id
            ,'quantity'=>$this->faker->numberBetween(10,100),
            'price'=>$this->faker->randomFloat(1,1,1),
            'income_id'=>Income::all()->random()->income_id
        ];
    }
}
