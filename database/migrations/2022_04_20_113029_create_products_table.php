<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->comment('1:product, 2:inhouse')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('barcode')->nullable();
            $table->string('code')->nullable();
            $table->string('weight')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('shop_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->decimal('sub_category_id',18,2)->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('image',255)->nullable();
            $table->decimal('sale_price',18,2)->nullable();
            $table->integer('status')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('unit')->nullable();
            $table->decimal('discount',18,2)->nullable();
            $table->integer('discount_type')->nullable();
            $table->decimal('vat',18,2)->nullable();
            $table->decimal('tax',18,2)->nullable();
            $table->decimal('quantity',18,2)->nullable();
            $table->integer('has_varient')->nullable();
            $table->text('varient_type_ids')->nullable();
            $table->string('package_charge_ids')->nullable();
            $table->integer('refundable')->nullable();
            $table->integer('sale_type')->comment('1:sale,2:not sale')->nullable();
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
        Schema::dropIfExists('products');
    }
}
