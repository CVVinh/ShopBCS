<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class nhanvien extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table="nhanvien";
    protected $guarded = 'nhanvien';
    protected $primaryKey="nv_ma";
    protected $fillable = 
    [
        'ten',
        'gioitinh',
        'ngaysinh',
        'sdt',
        'email',
        'diachi',
        'cccd',
        'hinh',
        'kichhoat',
        'lienketkichhoat',
        'ncc',
        'google_id',
        'facebook_id',
        'password',
        'tinhtrang',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function phieunhap(){
        return $this->hasMany(phieunhap::class,'pn_ma');
    }
    public function hoadon(){
        return $this->hasMany(hoadon::class,'hd_ma');
    }
    public function user(){
        return $this->hasOne(User::class,'nv_ma');
    }
}
