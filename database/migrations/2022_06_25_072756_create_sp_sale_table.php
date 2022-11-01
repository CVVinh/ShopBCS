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
        Schema::create('sp_sale', function (Blueprint $table) {
            $table->float('giamgia');
            $table->integer('sp_ma')->unsigned();
            $table->integer('sale_ma')->unsigned();

            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham');
            $table->foreign('sale_ma')->references('sale_ma')->on('sale');
            $table->primary(['sp_ma','sale_ma']);

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
        Schema::dropIfExists('sp_sales');
    }
};
