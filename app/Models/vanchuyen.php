<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vanchuyen extends Model
{
    use HasFactory;
    protected $table="vanchuyen";
    protected $primaryKey="vc_ma";
    protected $fillable = 
    [
        'vc_ten',
        'vc_tinhtrang',
    ];

    public function hoadon(){
        return $this->hasMany(hoadon::class,'vc_ma');
    }
}
