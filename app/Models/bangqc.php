<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bangqc extends Model
{
    use HasFactory;
    protected $table="bangqc";
    protected $primaryKey="qc_ma";
    protected $fillable = 
    [
        'qc_ten',
        'qc_tinhtrang',
    ];

    public function hinhqcs(){
        return $this->hasMany(hinhqc::class,'qc_ma');
    }

}
