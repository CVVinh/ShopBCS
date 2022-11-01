<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhasanxuat extends Model
{
    use HasFactory;
    protected $table="nhasanxuat";
    protected $primaryKey="nsx_ma";
    protected $fillable = 
    [
        'nsx_ten',
        'nsx_diachi',
        'nsx_sdt',
        'nsx_email',
        'nsx_msthue',
        'nsx_tinhtrang',
    ];

    public function sanpham(){
        return $this->hasMany(sanpham::class,'nsx_ma');
    }
}
