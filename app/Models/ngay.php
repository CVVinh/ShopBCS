<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ngay extends Model
{
    use HasFactory;
    protected $table="ngay";
    protected $primaryKey="n_ma";
    protected $fillable = 
    [
        'n_ngay',
    ];

    public function sanpham(){
        return $this->belongsToMany(sanpham::class,'giaban','n_ma','sp_ma')->withPivot('giamgia','giaban','tinhtrang');
    }
}
