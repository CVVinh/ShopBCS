<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class voucher extends Model
{
    protected $table="voucher";
    protected $primaryKey="voucher_ma";
    protected $fillable = 
    [
        'soluong',
        'phantram',
        'kh_ma',
        'sp_km_ma',
        'voucher_ma',
    ];
    

    /* public function cthoadon(){
        return $this->hasOne(cthoadon::class,'voucher_ma');
    } */

    public function khachhang(){
        return $this->belongsTo(khachhang::class,'kh_ma');
    }
    public function sp_km(){
        return $this->belongsTo(sp_km::class,'sp_km_ma');
    }
}
