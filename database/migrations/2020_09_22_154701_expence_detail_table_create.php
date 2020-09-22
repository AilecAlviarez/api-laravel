<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExpenceDetailTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_expences',function (Blueprint $table){
            $table->id('detail_expence_id');
            $table->unsignedBigInteger('product_id');
             $table->unsignedBigInteger('expence_id');
             $table->integer('quantity')->unsigned();
             $table->decimal('price')->unsigned();
             $table->foreign('product_id')->references('product_id')->on('products');
             $table->foreign('expence_id')->references('expence_id')->on('expences');
            $table->timestamp();
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
