<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('user_id');
            $table->string('order_code');
            $table->integer('discount');
            $table->double('price');
            $table->double('shipping_cost');
            $table->double('total_price');
            $table->json('order')->nullable();
            $table->json('address')->nullable();
            $table->timestamp('order_date');
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('order_status_id');
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_id')->references('id')->on('payment_methods');
            $table->foreign('order_status_id')->references('id')->on('order_status');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
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
};
