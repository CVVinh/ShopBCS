<?php
namespace App\Classes;

use Mail;
use Exception;
use Carbon\Carbon;
use App\Models\khachhang;
use App\Models\kichhoatnguoidung;
use App\Mail\EmailKichHoatNguoiDung;
class DichVuKichHoat
{
    protected $thoiGianHetHanMa = 2; // Sẽ gửi lại mã xác thực sau 2 phut nếu thực hiện sendActivationMail()
    protected $kichHoat;
    public function __construct(kichhoatnguoidung $kichHoat)
    {
        $this->kichHoat = $kichHoat;
    }
    private function kiemTraGuiMail($user)
    {
        $kh = $this->kichHoat->layMaKichHoat($user);
        return $kh === null || strtotime($kh->created_at) + 60 * $this->thoiGianHetHanMa < time();
    }

    public function thoiGianMaXacThuc($token){
        $kh = $this->kichHoat->layMaKichHoatBangToken($token);
        return $kh === null || strtotime($kh->created_at) + 60 * $this->thoiGianHetHanMa >= time();
    }

    public function guiEmailKichHoat($user)
    {
        if ($user->active || !$this->kiemTraGuiMail($user)) return false;
        $token = $this->kichHoat->taoMaKichHoat($user);
        $user->lienketkichhoat = route('nguoiDung.kichHoat', $token);
        $user->save();
        try{
            $guiEMail = new EmailKichHoatNguoiDung($user);
            Mail::to($user->email)->send($guiEMail);
            return true;
        }
        catch(Exception $e){
            echo "loi gui email: ".$e;
            $user->lienketkichhoat = null;
            $user->save();
            //$user->delete();
            return false;
        }
    }

    public function kichHoatKhachHang($token)
    {
        $kh = $this->kichHoat->layMaKichHoatBangToken($token);
        if ($kh === null) return null;
        $user = khachhang::find($kh->user_id);
        $user->kichhoat = true;
        $user->lienketkichhoat = null;
        $user->save();
        $this->kichHoat->xoaMaKichHoat($token);

        return $user;
    }

    
    
}