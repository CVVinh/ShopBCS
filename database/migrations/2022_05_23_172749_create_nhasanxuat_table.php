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
        Schema::create('nhasanxuat', function (Blueprint $table) {
            $table->increments('nsx_ma');
            $table->string('nsx_ten');
            $table->string('nsx_diachi');
            $table->string('nsx_sdt', 11)->unique();
            $table->string('nsx_email', 40)->unique();
            $table->string('nsx_msthue', 11)->unique();
            $table->string('nsx_tinhtrang')->default('1');

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
        Schema::dropIfExists('nhasanxuat');
    }
};
