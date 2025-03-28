<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('consolidated_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('customer_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->foreignId('product_id');
            $table->string('product_name');
            $table->string('sku', 100);
            $table->integer('quantity');
            $table->decimal('item_price', 10, 2);
            $table->decimal('line_total', 10, 2);
            $table->dateTime('order_date');
            $table->string('order_status', 50);
            $table->decimal('order_total', 10, 2);
            $table->timestamps();
            $table->index('order_id');
            $table->index('customer_id');
            $table->index('product_id');
            $table->index('order_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('consolidated_orders');
    }
};
