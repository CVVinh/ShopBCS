<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giaban', function (Blueprint $table) {
            $table->float('giaban');
            $table->float('giamgia');
            $table->string('tinhtrang')->default('1');
            $table->timestamps();

            $table->integer('sp_ma')->unsigned();
            $table->integer('dv_ma')->unsigned();
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham');
            $table->foreign('dv_ma')->references('dv_ma')->on('donvi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giaban');
    }
};
