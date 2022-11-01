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
        Schema::create('ctphieunhap', function (Blueprint $table) {
            $table->unsignedInteger('sp_ma');
            $table->unsignedInteger('pn_ma');
            $table->integer('soluong');
            $table->float('gianhap');
            $table->string('thanhtien');
            $table->primary(['sp_ma','pn_ma']);
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham');
            $table->foreign('pn_ma')->references('pn_ma')->on('phieunhap');
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
        Schema::dropIfExists('ctphieunhap');
    }
};
