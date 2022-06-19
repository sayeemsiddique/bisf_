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
            $table->integer('type')->comment('1:in,2:out,3:initial in')->nullable();
            $table->integer('tracking_code')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('shipping_address')->nullable();
            $table->integer('delivery_status')->nullable();
            $table->integer('payment_status')->nullable();
            $table->decimal('total_price',18,2)->comment('without vat,tax')->nullable();
            $table->decimal('grand_total_price',18,2)->nullable();
            $table->decimal('coupon_discount',18,2)->nullable();
            $table->decimal('shipping_cost',18,2)->nullable();
            $table->integer('code')->nullable();
            $table->integer('update_by')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
