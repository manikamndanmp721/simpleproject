<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('customer_name');
            $table->bigInteger('phone_number')->unsigned();
            $table->bigInteger('net_amount')->unsigned();
            $table->timestamp('order_date')->nullable();
            $table->timestamps();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('qty')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
