<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class combo extends Model
{
    use HasFactory;

    protected $table="combo";
    protected $primaryKey="id";
    public $timestamps = false;
    protected $fillable = 
    [
        'idspgoc',
        'idspphu',
        'dv_ma',
    ];

    public function sanphamgoc(){
        return $this->belongsTo(sanpham::class,'idspgoc','sp_ma');
    }

    public function sanphamphu(){
        return $this->belongsTo(sanpham::class ,'idspphu','sp_ma');
    }
    
    public function donvi(){
        return $this->belongsTo(donvi::class,'dv_ma');
    }

    

}
