<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Detail_Expence;
use App\Models\Detail_Income;
use App\Models\Expence;
use App\Models\Income;
use App\Models\Inventary;
use App\Models\MethodPay;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::factory(60)->create();
        Category::factory(10)->create();
        Status::factory(3)->create();
        MethodPay::factory(2)->create();
        Expence::factory(30)->create();
        Product::factory(100)->create();


        /*DB::table('method_pays')->insert(['type'=>MethodPay::NOACH
        ]);
        DB::table('method_pays')->insert(['type'=>MethodPay::ACH]);*/


        Income::factory(50)->create();
        Detail_Income::factory(100)->create();
        Detail_Expence::factory(60)->create();
        Inventary::factory(100)->create();

    }
}
