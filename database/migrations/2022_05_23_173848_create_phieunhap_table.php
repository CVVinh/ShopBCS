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
        Schema::create('phieunhap', function (Blueprint $table) {
            $table->increments('pn_ma');
            $table->date('pn_ngaynhap');
            $table->float('pn_tongtien');
            $table->string('pn_tinhtrang')->default('0');
            $table->integer('nv_ma')->unsigned();
            $table->foreign('nv_ma')->references('nv_ma')->on('nhanvien');

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
        Schema::dropIfExists('phieunhap');
    }
};
