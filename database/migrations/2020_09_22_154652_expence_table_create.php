<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExpenceTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expences',function (Blueprint $table){
           $table->id('expence_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('total')->unsigned();
              $table->unsignedBigInteger('status_id');
                $table->unsignedBigInteger('method_pay_id');
                $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('status_id')->references('status_id')->on('status');
            $table->foreign('method_pay_id')->references('method_pay_id')->on('method_pays');
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
