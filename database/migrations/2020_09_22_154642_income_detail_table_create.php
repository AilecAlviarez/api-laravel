<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IncomeDetailTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_incomes',function (Blueprint $table){
               $table->id('detail_income_id');

               $table->unsignedBigInteger('product_id');
               $table->integer('quantity')->unsigned();
               $table->decimal('price')->unsigned();
               $table->unsignedBigInteger('income_id');
               $table->foreign('product_id')->references('product_id')->on('product_id');
               $table->foreign('income_id')->references('income_id')->on('income_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
