<?php

namespace Database\Seeders;
use App\Models\nhanvien;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nhanvien1 = nhanvien::create([
            'ten' => 'Nhanvien 1', 
            'gioitinh' => 'nam',
            'ngaysinh' => now(),
            'email' => 'nhanvien1@allaravel.dev',
            'diachi' => 'Can Tho',
            'cccd' => '0123456789',
            'password' => bcrypt('123456')
        ]);

        $nhanvien2 = nhanvien::create([
            'ten' => 'Nhanvien 2', 
            'gioitinh' => 'nam',
            'ngaysinh' => now(),
            'email' => 'nhanvien2@allaravel.dev',
            'diachi' => 'Can Tho',
            'cccd' => '0123456790',
            'password' => bcrypt('123456')
        ]);

        $nhanvien3 = nhanvien::create([
            'ten' => 'Nhanvien 3', 
            'gioitinh' => 'nam',
            'ngaysinh' => now(),
            'email' => 'nhanvien3@allaravel.dev',
            'diachi' => 'Can Tho',
            'cccd' => '0123456791',
            'password' => bcrypt('123456')
        ]);
    }
}
