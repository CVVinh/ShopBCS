<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class sp_sale extends Model
{
    use HasFactory;

    protected $table="sp_sale";
    protected $fillable = 
    [
        'sale_tgbd',
        'sale_tgkt',
        'sale_noidung',
        'sale_tinhtrang',
        
    ];

}
