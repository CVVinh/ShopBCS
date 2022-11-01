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
        Schema::create('hinhqc', function (Blueprint $table) {
            $table->increments('hqc_ma');
            $table->string('hqc_ten');
            $table->string('hqc_tinhtrang')->default('1');
            $table->integer('qc_ma')->unsigned();
            $table->foreign('qc_ma')->references('qc_ma')->on('bangqc');
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
        Schema::dropIfExists('hinhqc');
    }
};
