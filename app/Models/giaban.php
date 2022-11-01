<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class giaban extends Pivot
{
    protected $table="giaban";
    public $timestamps = false;
    protected $fillable = 
    [
        'giaban',
        'giamgia',
        'tinhtrang',
        'dv_ma',
        'sp_ma',
    ];

    public function donvi(){
        return $this->belongsTo(donvi::class,'dv_ma');
    }
    
    
}
