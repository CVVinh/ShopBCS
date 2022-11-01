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
        Schema::create('ctkhuyenmai', function (Blueprint $table) {
            $table->unsignedInteger('sp_ma');
            $table->unsignedInteger('km_ma');
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham');
            $table->foreign('km_ma')->references('km_ma')->on('khuyenmai');
            $table->primary(['sp_ma','km_ma']);

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
        Schema::dropIfExists('ctkhuyenmai');
    }
};
