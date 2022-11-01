<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class diachi extends Model
{
    use HasFactory;
    protected $table="diachi";
    protected $primaryKey="dc_ma";
    protected $fillable = 
    [
        'dc_ten',
        'dc_sdt',
        'dc_tenkh',
        'kh_ma',
        'dc_tinhtrang',
    ];
    public function khachhang(){
        return $this->belongsTo(khachhang::class,'kh_ma');
    }

    public function hoadons(){
        return $this->hasMany(hoadon::class,'dc_ma');
    }
}
