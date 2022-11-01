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
        Schema::create('thongtinshop', function (Blueprint $table) {
            $table->increments('shop_ma');
            $table->string('shop_ten');
            $table->string('shop_sdt');
            $table->string('shop_diachi');
            $table->string('shop_email');
            $table->string('shop_logo');
            $table->string('shop_maugd');
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
        Schema::dropIfExists('thongtinshop');
    }
};
