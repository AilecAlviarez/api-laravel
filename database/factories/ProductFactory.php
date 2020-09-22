<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name'=>$this->faker->name
            ,'product_price'=>$this->faker->randomFloat(1,1,1),
            'product_description'=>$this->faker->paragraph(2),
            'category_id'=>Category::all()->random()->category_id
        ];
    }
}
