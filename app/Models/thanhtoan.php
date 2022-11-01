<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thanhtoan extends Model
{
    use HasFactory;
    protected $table="thanhtoan";
    protected $primaryKey="tt_ma";
    protected $fillable = 
    [
        'tt_ten',
        'tt_tinhtrang',
    ];
    public function hoadon(){
        return $this->hasMany(hoadon::class,'tt_ma');
    }
}
