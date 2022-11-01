<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class sanpham extends Model
{
    use HasFactory;
    protected $table="sanpham";
    protected $primaryKey="sp_ma";
    protected $fillable = 
    [
        'sp_ten',
        'sp_hinh',
        'sp_soluong',
        'sp_mota',
        'sp_thongtin',
        'sp_tinhtrang',
        'nsx_ma',
        'lsp_ma',
    ];

    public function hinhsps(){
        return $this->hasMany(hinhsp::class,'sp_ma');
    }
    
    public function donvis(){
        return $this->belongsToMany(donvi::class,'giaban','sp_ma','dv_ma')->withPivot('giaban','giamgia', 'tinhtrang', 'dv_ma', 'sp_ma')->using(giaban::class);
    }

    public function loaisp(){
        return $this->belongsTo(loaisp::class,'lsp_ma');
    }
    public function nhasanxuat(){
        return $this->belongsTo(nhasanxuat::class,'nsx_ma');
    }   
    public function hoadon(){
        return $this->belongsToMany(hoadon::class,'cthoadon','sp_ma','hd_ma')->withPivot('id','soluong','giaban', 'giagoc','thanhtien', 'idspkm', 'dv_ma')->using(cthoadon::class);
    }
    public function phieunhaps(){
        return $this->belongsToMany(phieunhap::class,'ctphieunhap','sp_ma','pn_ma')->withPivot('soluong','gianhap','thanhtien');
    }
    /* public function ngay(){
        return $this->belongsToMany(ngay::class,'giaban','sp_ma','n_ma')->withPivot('giamgia','giaban','tinhtrang');
    } */
    public function khuyenmais(){
        return $this->belongsToMany(khuyenmai::class,'sp_km','sp_ma','km_ma')->withPivot('mota','phantram','loaikm','sp_km_ma', 'dv_ma', 'sp_ma', 'km_ma')->using(sp_km::class);
    }
    
    public function khuyenmai(){
        return $this->hasOne(khuyenmai::class,'sp_ma');
    }

    public function khachhang(){
        return $this->belongsToMany(khachhang::class,'danhgia','sp_ma','kh_ma')->withPivot('sp_ma','kh_ma','sosao')->using(danhgia::class);
    }
    public function sales(){
        return $this->belongsToMany(sale::class,'sp_sale','sp_ma','sale_ma')->withPivot('giamgia');
    }

    public function combosp(){
        return $this->hasMany(combo::class,'idspgoc');
    }


}
