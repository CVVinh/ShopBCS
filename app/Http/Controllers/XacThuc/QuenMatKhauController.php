<?php

namespace App\Http\Controllers\XacThuc;

use Exception;
use Carbon\Carbon; 
use App\Models\nhanvien;
use App\Models\khachhang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\datlaimatkhau; 
use App\Mail\EmailDatLaiMatKhau;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class QuenMatKhauController extends Controller
{
    protected $resendAfter = 2;

    public function quenMatKhau()
    {
        return view('xacthuc.quenMK');
    }
  
    public function quenMatKhauPost(Request $request)
    {
        $thongBao = [
            'email.exists' => 'Địa chỉ email không tồn tại!',
            'g-recaptcha-response.required' => "Captcha là được yêu cầu.",
            'g-recaptcha-response.recaptcha' => "Tôi không phải là người máy.",
            ];
        $validator = Validator::make($request->all(), [
            'email' => 'exists:khachhang',
            'g-recaptcha-response'=>'required|recaptcha',
        ], $thongBao);

        if($validator->fails()) {
            $validator->errors()->add('formDoiMKEmail', 'formDoiMKEmail');
            return back()->withErrors($validator)->withInput();
        } 

        $user = khachhang::where('email', $request->email)->first();
        if(!$user->kichhoat){
            return back()->with('thongBaoDoiMKEmail', 'Bạn vui lòng kiểm tra email để kích hoạt tài khoản trước khi thay đổi mật khẩu!');
        }
        $user = datlaimatkhau::where('email', $request->email)->first(); 
        $token = hash_hmac('sha256', str_random(40), config('app.key'));
        
        if($user){
            $thoiGianSuDungLink = strtotime($user->created_at) + 60 * $this->resendAfter < time();
            
            if($thoiGianSuDungLink){
                datlaimatkhau::where('email', $user->email)->update([
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
            } 
            else {
                return back()->with('thongBaoDoiMKEmail', 'Link xác thực đã được gửi đến email '.$request->email.' Link xác thực sẽ hết hiệu lực trong 2 phút.');
            }
        }else {
            $user = datlaimatkhau::create([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
        }
        try {
            $guiMail = new EmailDatLaiMatKhau($token);
            Mail::to($request->email)->send($guiMail);
           }  
        catch(Exception $e){
            $user->delete();
            return back()->with('loiDoiMKEmail', 'Không thể gửi email xác thực, bạn vui lòng thử lại.');
        }
        return back()->with('thongBaoDoiMKEmail', 'Bạn vui lòng xác nhận email để đặt lại mật khẩu.');
    }

    public function datLaiMatKhau($token) { 
        $user = datlaimatkhau::where('token', $token)->first();
        if(!$user) {
            return redirect('dangNhap')->with(['loiDoiMKEmail' => 'Lỗi xảy ra trong quá trình xác thực!!']); 
        }
        $thoiGianSuDungLink = strtotime($user->created_at) + 60 * $this->resendAfter < time();
        if($thoiGianSuDungLink){
            return redirect('dangNhap')->with(['loiDoiMKEmail' => 'Khóa đã hết hạn, bạn vui lòng đăng nhập lại để nhận mã xác nhận!']); 
        }
        return view('xacthuc.quenMKLink', ['token' => $token]);
    }

    public function datLaiMatKhauPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'exists:khachhang',
        ], ['email.exists' => 'Địa chỉ email không tồn tại!',]);

        if($validator->fails()) {
            $validator->errors()->add('formDoiMatKhauEmail', 'formDoiMatKhauEmail');
            return back()->withErrors($validator)->withInput();
        } 

        $capNhatMK = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();

        if(!$capNhatMK){
            return back()->withInput()->with('loiDatLaiMatKhau', 'Mã xác nhận hoặc tên người dùng không hợp lệ!');
        }
        $user = khachhang::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        return redirect('/dangNhap')->with('dangNhapThanhCong', 'Mật khẩu của bạn đã được thay đổi!');
    }

    // thay doi mat khau bang dien thoai
    
    public function datLaiMatKhauBangDienThoai(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sdt' => 'exists:khachhang',
        ], ['sdt.exists' => 'Người dùng không tồn tại!']);

        if($validator->fails()){
            $validator->errors()->add('formDoiMatKhauSDT', 'formDoiMatKhauSDT');
            return back()->withErrors($validator)->withInput();
        }
        
        khachhang::where('sdt', $request->sdt)->update(['password' => Hash::make($request->password)]);;
        return redirect('/dangNhap')->with('dangNhapThanhCong', 'Mật khẩu của bạn đã được thay đổi!');
    }

}
