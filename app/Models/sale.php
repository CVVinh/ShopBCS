<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class sale extends Model
{
    use HasFactory;

    protected $table="sale";
    protected $primaryKey="sale_ma";
    protected $fillable = 
    [
        'sale_tgbd',
        'sale_tgkt',
        'sale_noidung',
        'sale_tinhtrang',
        
    ];

    public function sanphams(){
        return $this->belongsToMany(sanpham::class,'sp_sale','sale_ma','sp_ma')->withPivot('giamgia');
    }
    
}
