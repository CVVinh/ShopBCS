<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class donvi extends Model
{
    use HasFactory;
    protected $table="donvi";
    protected $primaryKey="dv_ma";
    protected $fillable = 
    [
        'dv_ten',
        'dv_tinhtrang',
    ];
    
    public function sanphams(){
        return $this->belongsToMany(sanpham::class,'giaban','dv_ma','sp_ma')->withPivot('giaban','giamgia','tinhtrang', 'dv_ma', 'sp_ma')->using(giaban::class);
    }

    public function cthoadon(){
        return $this->hasOne(cthoadon::class,'dv_ma');
    }

    public function sp_km(){
        return $this->hasOne(sp_km::class,'dv_ma');
    }

}
