<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class datlaimatkhau extends Model
{
    use HasFactory;

    protected $table = 'password_resets';
    protected $fillable = ['id', 'email', 'token'];
}
