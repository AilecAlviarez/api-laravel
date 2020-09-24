<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InventaryTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventary', function (Blueprint $table) {
            $table->id('inventary_id');
            $table->integer('cant_product_current');
            $table->integer('stock_max')->unsigned()->default(30);
             $table->integer('stock_min')->unsigned()->default(10);
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');


            $table->timestamps();
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
