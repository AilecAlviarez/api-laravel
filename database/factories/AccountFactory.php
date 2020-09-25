<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bank_id'=>Bank::all()->random()->bank_id
            ,'account_number'=>$this->faker->bankAccountNumber,
            'user_id'=>User::all()->where('role','==',User::NOADMIN)->random()->user_id,
            'saldo'=>$this->faker->randomFloat(1,10,200)

        ];
    }
}
