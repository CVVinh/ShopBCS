<?php

namespace Database\Seeders;
use App\Models\khachhang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KhachHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $khachhang1 = khachhang::create([
            'ten' => 'Khachhang 1', 
            'gioitinh' => 'nam',
            'ngaysinh' => now(),
            'email' => 'khachhang1@allaravel.dev',
            'password' => bcrypt('123456')
        ]);

        $khachhang2 = khachhang::create([
            'ten' => 'Khachhang 2', 
            'gioitinh' => 'nam',
            'ngaysinh' => now(),
            'email' => 'khachhang2@allaravel.dev',
            'password' => bcrypt('123456')
        ]);

        $khachhang3 = khachhang::create([
            'ten' => 'Khachhang 3', 
            'gioitinh' => 'nam',
            'ngaysinh' => now(),
            'email' => 'khachhang3@allaravel.dev',
            'password' => bcrypt('123456')
        ]);
    }
}
