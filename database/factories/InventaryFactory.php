<?php

namespace Database\Factories;

use App\Models\Inventary;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InventaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id'=>Product::all()->random()->product_id,
            'cant_product_current'=>$this->faker->numberBetween(10,20000),
            'stock_max'=>$this->faker->numberBetween(30,500)
            ,'stock_min'=>$this->faker->numberBetween(10,29)
        ];
    }
}
