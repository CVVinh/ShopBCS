<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class cthoadon extends Pivot
{
    protected $table="cthoadon";
    protected $fillable = 
    [
        'id',
        'soluong',
        'giaban',
        'giagoc',
        'thanhtien',
        'idspkm',
        'dv_ma',
    ];

    /*  public function voucher(){
        return $this->belongsTo(voucher::class,'voucher_ma');
    } */

    public function donvi(){
        return $this->belongsTo(donvi::class,'dv_ma');
    }

}
