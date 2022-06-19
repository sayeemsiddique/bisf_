<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->decimal('amount',18,2)->nullable();
            $table->string('payment_method')->nullable();
            $table->integer('payment_approved')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('branch_id')->nullable();
            $table->date('check_date')->nullable();
            $table->string('account_number')->nullable();
            $table->string('check_number')->nullable();
            $table->string('chalan_code')->nullable();
            $table->integer('status')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
