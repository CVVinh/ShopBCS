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
        Schema::create('sanpham', function (Blueprint $table) {
            $table->increments('sp_ma');
            $table->string('sp_ten');
            $table->string('sp_hinh')->nullable();
            $table->integer('sp_soluong');
            $table->float('sp_gianhap');
            $table->text('sp_mota')->nullable();
            $table->text('sp_thongtin')->nullable();
            $table->string('sp_tinhtrang')->default('1');

            $table->integer('nsx_ma')->unsigned();
            $table->integer('lsp_ma')->unsigned();
            
            $table->foreign('lsp_ma')->references('lsp_ma')->on('loaisp');
            $table->foreign('nsx_ma')->references('nsx_ma')->on('nhasanxuat');
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
        Schema::dropIfExists('sanpham');
    }
};
