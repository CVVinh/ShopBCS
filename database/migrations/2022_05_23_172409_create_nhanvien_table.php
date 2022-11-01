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
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->increments('nv_ma');
            $table->string('ten', 40);
            $table->string('gioitinh', 5)->default('Nam')->nullable();
            $table->date('ngaysinh')->default(now())->nullable();
            $table->string('sdt', 11)->nullable();
            $table->string('email', 40)->nullable();
            $table->string('diachi')->nullable();
            $table->string('cccd', 15)->unique();
            $table->string('hinh')->nullable();
            $table->string('matkhau');
            $table->rememberToken();
            $table->boolean('kichhoat')->default(false);
            $table->string('lienketkichhoat')->nullable();
            $table->string('nhacungcap')->default('google')->nullable();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('tinhtrang')->default('1')->nullable();
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
        Schema::dropIfExists('nhanvien');
    }
};
