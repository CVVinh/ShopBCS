<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class sp_km extends Pivot
{
    protected $table="sp_km";
    protected $primaryKey="sp_km_ma";
    protected $fillable = 
    [
        'mota',
        'phantram',
        'loaikm',
        'sp_km_ma',
        'dv_ma',
        'sp_ma',
        'km_ma',
        
    ];
    public function khachhangs(){
        return $this->belongsToMany(khachhang::class,'voucher','sp_km_ma','kh_ma')->withPivot('soluong', 'phantram','kh_ma','sp_km_ma','voucher_ma');
    }
    
    public function donvi(){
        return $this->belongsTo(donvi::class,'dv_ma');
    }

}
