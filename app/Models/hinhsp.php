<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hinhsp extends Model
{
    use HasFactory;
    protected $table="hinhsp";
    protected $primaryKey="h_ma";
    protected $fillable = 
    [
        'h_ten',
        'h_tinhtrang',
        'sp_ma',
    ];
    public function sanpham(){
        return $this->belongsTo(sanpham::class,'sp_ma');
    }
}
