<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order__summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('order_number');
            $table->foreignId('billing_details_id');
            $table->string('coupon_name')->nullable();
            $table->integer('total');
            $table->integer('discount');
            $table->integer('subtotal');
            $table->integer('shipping');
            $table->integer('delivery_status')->default(1)->comment('1=pending,2=complete');
            $table->integer('payment_status')->default(1)->comment('1=unpaid,2=paid');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order__summaries');
    }
}
