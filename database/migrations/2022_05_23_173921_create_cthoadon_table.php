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
        Schema::create('cthoadon', function (Blueprint $table) {
            $table->unsignedInteger('sp_ma');
            $table->unsignedInteger('voucher_ma')->nullable();
            $table->unsignedInteger('hd_ma');
            $table->unsignedInteger('dv_ma');
            $table->integer('soluong');
            $table->float('giaban')->nullable();
            $table->float('giagoc')->nullable();
            $table->float('thanhtien')->nullable();
            $table->primary(['sp_ma','hd_ma']);
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham');
            $table->foreign('hd_ma')->references('hd_ma')->on('hoadon');
            $table->foreign('voucher_ma')->references('id')->on('voucher');
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
        Schema::dropIfExists('cthoadon');
    }
};
