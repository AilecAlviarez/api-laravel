<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TriggerExpenceDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     /*   DB::unprepared('CREATE TRIGGER update_quantity AFTER INSERT ON detail_expences
         FOR EACH ROW BEGIN UPDATE inventary SET cant_product_current=cant_product_current-NEW.quantity WHERE product_id=NEW.product_id;
         END');*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        //DB::unprepared('DROP TRIGGER `update_quantity`');
    }
}
