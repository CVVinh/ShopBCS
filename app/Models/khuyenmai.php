<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class khuyenmai extends Model
{
    use HasFactory;
    protected $table="khuyenmai";
    protected $primaryKey="km_ma";
    protected $fillable = 
    [
        'km_ngaybd',
        'km_ngaykt',
        'sp_ma',
        'km_tinhtrang',
    ];

    public function sanphams(){
        return $this->belongsToMany(sanpham::class,'sp_km','km_ma','sp_ma')->withPivot('mota','phantram','loaikm','sp_km_ma', 'dv_ma', 'sp_ma', 'km_ma')->using(sp_km::class);
    }

    public function sanpham(){
        return $this->belongsTo(sanpham::class,'sp_ma');
    }
    
}
