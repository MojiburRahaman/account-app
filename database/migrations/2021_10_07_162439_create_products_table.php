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
            $table->string('title');
            $table->string('slug');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->foreignId('catagory_id');
            $table->foreignId('subcatagory_id');
            $table->foreignId('brand_id')->nullable();
            $table->string('thumbnail_img');
            $table->string('status')->default(1)->comment('1=active , 2=Inactive');
            $table->integer('most_view')->default(0);
            $table->string('certified')->default('2');
            $table->text('product_summary');
            $table->text('product_description');
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
        Schema::dropIfExists('products');
    }
}
