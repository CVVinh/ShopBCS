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
        Schema::create('danhgia', function (Blueprint $table) {
            $table->unsignedInteger('sp_ma');
            $table->unsignedInteger('kh_ma');
            $table->primary(['sp_ma','kh_ma']);
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham');
            $table->foreign('kh_ma')->references('kh_ma')->on('khachhang');
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
        Schema::dropIfExists('danhgia');
    }
};
