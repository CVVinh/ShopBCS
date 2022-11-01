<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class danhgia extends Pivot
{
    protected $table="danhgia";
    protected $fillable = 
    [
        'sp_ma',
        'kh_ma',
        'sosao',
        
        
    ];
}
