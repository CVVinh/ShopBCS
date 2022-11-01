<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class hoadon extends Model
{
    use HasFactory;
    protected $table="hoadon";
    protected $primaryKey="hd_ma";
    public $timestamps = true;
    protected $fillable = 
    [
        'hd_ngaykt',
        'hd_ngaytt',
        'hd_tongtien',
        'hd_tinhtrang',
        'dc_ma',
        'nv_ma',
        'vc_ma',
        'tt_ma',
        'kh_ma',
    ];

    public function nhanvien(){
        return $this->belongsTo(nhanvien::class,'nv_ma');
    }
    public function vanchuyen(){
        return $this->belongsTo(vanchuyen::class,'vc_ma');
    }
    public function thanhtoan(){
        return $this->belongsTo(thanhtoan::class,'tt_ma');
    }
    public function khachhang(){
        return $this->belongsTo(khachhang::class,'kh_ma');
    }
    public function sanphams(){
        return $this->belongsToMany(sanpham::class,'cthoadon','hd_ma','sp_ma')->withPivot('id','soluong','giaban', 'giagoc','thanhtien', 'idspkm', 'dv_ma')->using(cthoadon::class);
    }

    public function diachi(){
        return $this->belongsTo(diachi::class,'dc_ma');
    }
    
}
