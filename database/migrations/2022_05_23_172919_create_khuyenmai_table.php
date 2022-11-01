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
        Schema::create('khuyenmai', function (Blueprint $table) {
            $table->increments('km_ma');
            $table->datetime('km_ngaybd');
            $table->datetime('km_ngaykt');
            $table->integer('sp_ma')->unsigned();
            $table->string('km_tinhtrang')->default('1');
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham');
            
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
        Schema::dropIfExists('khuyenmai');
    }
};
