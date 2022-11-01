<?php

namespace App\Http\Controllers\XacThuc;

use Exception;
use App\Models\Users;
use App\Models\nhanvien;
use App\Models\khachhang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class XacThucFBGController extends Controller
{
    protected $redirectTo = '/';
    public function __construct(){
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    public function dieuHuongDenNCC($provider)
    {
        if (strcmp($provider, 'google') == 0) {
            if (!Session::has('pre_url')) {
                Session::put('pre_url', URL::previous());
            } else {
                if (URL::previous() != URL::to('login')) {
                    Session::put('pre_url', URL::previous());
                }
            }
        }
        return Socialite::driver($provider)->redirect();
    }  

    /**
     * Lấy thông tin từ Provider, kiểm tra nếu người dùng đã tồn tại trong CSDL
     * thì đăng nhập, ngược lại nếu chưa thì tạo người dùng mới trong SCDL.
     *
     * @return Response
     */
    public function xulyCacLoaiDangNhap($provider)
    {
        try{
            $user = Socialite::driver($provider)->user();
            $timNguoiDung = khachhang::where('email', $user->email)->first();
            $timAdmin = nhanvien::where('email', $user->email)->first();
            
            if (strcmp($provider, 'google') == 0) {
                $xacThucNguoiDung = $this->timHoacTaoNguoiDung($user, $provider, 'google_id', $timNguoiDung, $timAdmin);
            }else {
                $xacThucNguoiDung = $this->timHoacTaoNguoiDung($user, $provider, 'facebook_id', $timNguoiDung, $timAdmin);
            }
            
            if($timAdmin){
                Auth::guard('nv')->login($xacThucNguoiDung, true);
            }
            else auth()->guard('kh')->login($xacThucNguoiDung, true);
            //return Redirect::to(Session::get('pre_url'));
            return redirect()->intended('/')->with(['thongBaoChaoMung' => 'Chúc mừng bạn đã đăng nhập thành công!']);
            
        }catch(Exception $e){
            //dd($e->getMessage());
            return redirect('auth/'.$provider);
        }
    }

    /**
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function timHoacTaoNguoiDung($user, $provider, $typeId, $timNguoiDung, $timAdmin)
    {
        if ($timNguoiDung) {
            $xacThucNguoiDung = khachhang::where($typeId, $user->id)->first();
            if ($xacThucNguoiDung) {
                return $xacThucNguoiDung;
            }else {
                $timNguoiDung->update([
                    'kichhoat' => true,
                    'nhancungcap' => $provider,
                    'lienketkichhoat' => null,
                    $typeId => $user->id,
                ]);
                return $timNguoiDung;
            }
        }else if ($timAdmin) {
            $xacThucNguoiDung = nhanvien::where($typeId, $user->id)->first();
            if ($xacThucNguoiDung) {
                return $xacThucNguoiDung;
            }else {
                $timAdmin->update([
                    'kichhoat' => true,
                    'nhancungcap' => $provider,
                    'lienketkichhoatoat'  => null,
                    $typeId => $user->id,
                ]);
                return $timAdmin;
            }
        }else {
            return khachhang::create([
            'ten'     => $user->name ? $user->name : Str::random(10),
            'email'    => $user->email,
            'password' => bcrypt(random_int(100000, 999999)),
            'kichhoat'   => true,
            'nhancungcap' => $provider,
            $typeId    => $user->id,
            ]);
        }
    }
    
}
