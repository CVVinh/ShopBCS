<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongtinshop extends Model
{
    use HasFactory;
    protected $table="thongtinshop";
    protected $primaryKey="shop_ma";
    protected $fillable = 
    [
        'shop_ten',
        'shop_sdt',
        'shop_diachi',
        'shop_email',
        'shop_logo',
        'shop_maugd',
    ];
}
