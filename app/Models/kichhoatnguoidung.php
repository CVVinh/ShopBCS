<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kichhoatnguoidung extends Model
{
    use HasFactory;

    protected $table = 'kichhoatnguoidung';
    protected $fillable = ['user_id', 'token', 'updated_at', 'created_at'];
    
    protected function layToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }
    public function layMaKichHoat($user)
    {
        return kichhoatnguoidung::where('user_id', $user->kh_ma)->first();
    }

    private function taoToken($user)
    {
        $token = $this->layToken();
        DB::beginTransaction();
        kichhoatnguoidung::insert([
            'user_id' => $user->kh_ma,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        DB::commit();
        return $token;
    }

    private function phucHoiToken($user)
    {
        $token = $this->layToken();
        kichhoatnguoidung::where('user_id', $user->kh_ma)->update([
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        return $token;
    }

    public function taoMaKichHoat($user)
    {
        $kh = $this->layMaKichHoat($user);

        if (!$kh) {
            return $this->taoToken($user);
        }
        return $this->phucHoiToken($user);
    }

    public function layMaKichHoatBangToken($token)
    {
        return kichhoatnguoidung::where('token', $token)->first();
    }

    public function xoaMaKichHoat($token)
    {
        kichhoatnguoidung::where('token', $token)->delete();
    }
    
}
