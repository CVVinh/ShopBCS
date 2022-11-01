<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thuoctinh extends Model
{
    use HasFactory;
    protected $table="thuoctinh";
    protected $primaryKey="tt_ma";
    protected $fillable = 
    [
        'tt_ten',
        'tt_noidung',
        'tt_tinhtrang',
        'sp_ma',
    ];

    public function sanpham(){
        return $this->belongsTo(sanpham::class,'sp_ma');
    }
}
