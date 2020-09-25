<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MethodPayTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('method_pays', function (Blueprint $table) {
            $table->id('method_pay_id');
            $table->timestamps();
            $table->string('delivery_address');

            $table->string('type');
            $table->string('description');
            $table->date('date_come');


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
