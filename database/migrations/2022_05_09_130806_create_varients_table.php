<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVarientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('varients', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->string('varient_type_id')->nullable();
            $table->integer('status')->nullable();
            $table->decimal('quantity',18,2)->nullable();
            $table->decimal('price',18,2)->nullable();
            $table->decimal('vat',18,2,)->nullable();
            $table->decimal('tax',18,2)->nullable();
            $table->decimal('discount',18,2)->nullable();
            $table->text('image',255)->nullable();
            $table->integer('discount_type')->nullable();
            $table->json('varient_data')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('varients');
    }
}
