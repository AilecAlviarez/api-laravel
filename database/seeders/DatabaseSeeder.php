<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Bank;
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
        $cant_user=60;
        $cant_category=10;
        $cant_status=3;
        $method_pay=2;
        $cant_bank=10;
        $cant_expence=30;
        $cant_product=100;
        $cant_income=50;
        $cant_detail_income=100;
        $cant_detail_expence=60;
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::factory($cant_user)->create();
      //  DB::table('users')->insert(['name'=>'yoyo','email'=>'mariaramireeez2002@gmail.com','password'=>'123456','role'=>User::ADMIN]);
        Category::factory($cant_category)->create();
        Status::factory($cant_status)->create();
        MethodPay::factory($method_pay)->create();
        Bank::factory($cant_bank)->create();
        Account::factory($cant_user)->create();


        Expence::factory($cant_expence)->create();
        Product::factory($cant_product)->create();
        /*DB::table('method_pays')->insert(['type'=>MethodPay::NOACH
        ]);
        DB::table('method_pays')->insert(['type'=>MethodPay::ACH]);*/


        Income::factory($cant_income)->create();
        Detail_Income::factory($cant_detail_income)->create();
        Detail_Expence::factory($cant_detail_expence)->create();
        Inventary::factory($cant_product)->create();

    }
}
