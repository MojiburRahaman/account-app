<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBestDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('best_deals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('status')->default('1');
            $table->string('discount');
            $table->string('deal_banner')->nullable();
            $table->string('deal_backgraound_color')->nullable();
            $table->string('expire_date');
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
        Schema::dropIfExists('best_deals');
    }
}
