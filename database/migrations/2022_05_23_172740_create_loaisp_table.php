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
        Schema::create('loaisp', function (Blueprint $table) {
            $table->increments('lsp_ma');
            $table->string('lsp_ten');
            $table->string('lsp_hinh');
            $table->string('lsp_tinhtrang')->default('1');
            $table->string('lsp_thuonghieu')->default(null);
            $table->integer('dm_ma')->unsigned();
            $table->foreign('dm_ma')->references('dm_ma')->on('danhmucsp');
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
        Schema::dropIfExists('loaisp');
    }
};
