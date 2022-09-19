<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('billing_user_name');
            $table->string('user_email');
            $table->string('billing_number');
            $table->string('division_name');
            $table->string('district_name');
            $table->string('upozila_name');
            $table->text('billing_address');
            $table->string('billing_postcode')->nullable();
            $table->text('billing_order_note')->nullable();
            $table->string('payment_option');
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
        Schema::dropIfExists('billing_details');
    }
}
