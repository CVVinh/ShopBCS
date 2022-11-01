<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hinhqc extends Model
{
    use HasFactory;
    protected $table="hinhqc";
    protected $primaryKey="hqc_ma";
    protected $fillable = 
    [
        'hqc_ten',
        'qc_ma',
        'hqc_tinhtrang',
    ];
    
    public function bangqc(){
        return $this->belongsTo(hinhqc::class,'qc_ma');
    }
}
