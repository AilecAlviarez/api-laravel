<?php

namespace Database\Factories;

use App\Models\Detail_Expence;
use App\Models\Expence;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class Detail_ExpenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Detail_Expence::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'product_id'=>Product::all()->random()->product_id
            ,'quantity'=>$this->faker->numberBetween(10,100),
            'price'=>$this->faker->randomFloat(1,1,1)
            ,'expence_id'=>Expence::all()->random()->expence_id
        ];
    }
}
