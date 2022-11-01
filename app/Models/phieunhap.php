<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phieunhap extends Model
{
    use HasFactory;
    protected $table="phieunhap";
    protected $primaryKey="pn_ma";
    public $timestamps = false;
    protected $fillable = 
    [
        'pn_ngaynhap',
        'pn_tongtien',
        'pn_tinhtrang',
        'nv_ma',
    ];

    public function sanphams(){
        return $this->belongsToMany(sanpham::class,'ctphieunhap','pn_ma','sp_ma')->withPivot('soluong','gianhap','thanhtien');
    }
    public function nhanvien(){
        return $this->belongsTo(nhanvien::class,'nv_ma');
    }
}
