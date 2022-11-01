<?php

namespace App\Http\Controllers\KhachHang;

use Exception;
use Carbon\Carbon;
use App\Models\sale;
use App\Models\donvi;
use App\Models\sp_km;
use App\Models\diachi;
use App\Models\giaban;
use App\Models\hoadon;
use App\Models\loaisp;
use App\Models\danhgia;
use App\Models\sanpham;
use App\Models\voucher;
use App\Models\cthoadon;
use App\Models\danhmucsp;
use App\Models\khachhang;
use App\Models\khuyenmai;
use App\Models\thanhtoan;
use App\Models\vanchuyen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\KhachHang\ChiTietSPController;

class HoSoController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function hoSoCaNhan()
    {
        return view('khachhang.thongtin.hoSoCaNhan', ['kh' => Auth::guard('kh')->user()]);
    }

    public function capNhatHoSo(Request $request)
    {
        $thongBao = [
            'ten.required'=>'Vui lòng nhập tên sử dụng',
            'sdt.required'=>'Vui lòng nhập số điện thoại',
            'sdt.exists' => 'Số điện thoại đã đăng ký!',
            'email.email' => "Email không hợp lệ",
            'email.exists' => 'Email đăng ký!',
        ];
        
        $khachHang = khachhang::where('kh_ma', $request->iDSPKHChiTiet)->first();
        if(strcmp($khachHang->sdt, $request->sdt)!=0){
            if($request->email){
                if(strcmp($khachHang->email, $request->email)!=0){
                    $validator = Validator::make($request->all(), [
                        'sdt' => 'exists:khachhang',
                        'email' => 'email|max:40|exists:khachhang',
                    ], $thongBao);
                }
            }else {
                $validator = Validator::make($request->all(), [
                    'sdt' => 'exists:khachhang',
                ], $thongBao);
            }
        }else {
            if($request->email){
                $validator = Validator::make($request->all(), [
                    'email' => 'email|max:40|exists:khachhang',
                ], $thongBao);
            }
        }
        if(isset($validator)){
            if($validator->fails()) {
                //$validator->errors()->add('formDangKy', 'formDangKy');
                return redirect()->back()->withErrors($validator)->withInput();
            } 
        }
          
        $tenFileAnh = null;
        
        if ($request->hasFile('hinh')){
            $fileAnh = $request->hinh;
            //dd($fileAnh->getRealPath());
            $tenFileAnh = $fileAnh->getClientOriginalName(); //Lấy Tên files
            $fileAnh->move('avatar', $tenFileAnh);
        }
        //dd($request, $request->hinh);
        //dd($request, $tenFileAnh);
        $khachHang = khachhang::where('kh_ma', $request->iDSPKHChiTiet)->first();
        $khachHang->update([
            'ten' => $request->ten,
            'gioitinh' => $request->gioitinh,
            'ngaysinh' => $request->ngaysinh,
            'sdt' => $request->sdt,
            'email' => $request->email,
            'hinh' => $tenFileAnh,
        ]);
        return redirect()->back()->with(['thanhCong'=>'Hồ sơ cập nhật thành công!']);
    }

    public static function tinhToanDonHang($iDKH)
    {
        HoSoController::tinhTienSP($iDKH);
        $phuongThucThanhToans = thanhtoan::all();
        $phuongThucVanChuyens = vanchuyen::all();
        $hoaDonKH = hoadon::where('kh_ma', $iDKH)->where('hd_tinhtrang', 0)->first();
        $diaChiKHs = diachi::where('kh_ma', $iDKH)->where('dc_tinhtrang', '1')->get();
        
        if($hoaDonKH===null){
            return view('khachhang.thongtin.donHang', compact('phuongThucThanhToans', 'phuongThucVanChuyens', 'diaChiKHs'));
        }
        else return view('khachhang.thongtin.donHang', compact('hoaDonKH', 'phuongThucThanhToans', 'phuongThucVanChuyens', 'diaChiKHs'));
    }
    
    public function donHang_Get()
    {
        return view('khachhang.thongtin.donHang');
    }

    public function donHang(Request $request)
    {
       return HoSoController::tinhToanDonHang($request->iDSPKHChiTiet);
    }
    public function thanhToanDonHang(Request $request) {
        //dd($request);
        $hoaDonKH = hoadon::where('kh_ma', $request->iDSPKHChiTiet)->where('hd_tinhtrang', 0)->first();
        $hoaDonKH->update(['dc_ma'=>$request->diaChiGiaoHang, 'hd_tinhtrang'=>'2', 'tt_ma'=>$request->radioPhuongThucThanhToan, 'vc_ma'=>$request->phuongThucVanChuyen, 'hd_tongtien'=>$request->thanhTien, 'hd_ngaytt'=>now()]);

        foreach($hoaDonKH->sanphams as $sanPham){
            $sanPham->update(['sp_soluong'=>$sanPham->sp_soluong-$sanPham->pivot->soluong]);
        }
        return HoSoController::layHetSPChoXacNhan($request->iDSPKHChiTiet);
    }
    public function gioHang_Get(){
        return view('khachhang.thongtin.gioHang');
    }

    public function gioHang(Request $request){
        return HoSoController::tinhTienSP($request->iDSPKHChiTiet, 'gioHang');
    }

    public static  function tinhTienSP($iDKH, $gioHang='gioHang')
    {
        //dd($request);
        $hoaDonKH = hoadon::where('kh_ma', $iDKH)->where('hd_tinhtrang', 0)->first();
        
        if($hoaDonKH==null){
            if(strcmp($gioHang, 'gioHang')==0){
                return view('khachhang.thongtin.gioHang');
            }
            return view('khachhang.thongtin.donHang');
        }
        $maxPhanTrams = [];
        $dVSPKMs = [];
        $iDSPKMs = [];
        $dsSPGioHangs = [];
        $i = 0;
        
        foreach($hoaDonKH->sanphams as $sanPham){            
            if($sanPham->pivot->idspkm!=null){
                $maSP = $sanPham->pivot->idspkm;
                if ($maSP!=-1) {
                    $layPhanTramSPKM = sp_km::where('sp_ma', $maSP)->where('km_ma', $sanPham->pivot->sp_ma)->first();
                    $phanTram = $layPhanTramSPKM->phantram;
                    foreach ($hoaDonKH->sanphams as $sanPham2) {
                        if ($sanPham2->pivot->idspkm!=null && $maSP == $sanPham2->pivot->idspkm) {
                            $layPhanTramSPKM1 = sp_km::where('km_ma', $sanPham2->pivot->sp_ma)->where('sp_ma', $sanPham2->pivot->idspkm)->where('dv_ma', $layPhanTramSPKM->dv_ma)->first();
                            if ($layPhanTramSPKM1!=null && $phanTram < $layPhanTramSPKM1->phantram) {
                                $phanTram = $layPhanTramSPKM1->phantram;
                            }
                        }
                    }
                    $maxPhanTrams[$sanPham->pivot->idspkm] = $phanTram; // phan tram
                    $dVSPKMs[$sanPham->pivot->idspkm] = $layPhanTramSPKM->dv_ma; // don vi sp km
                }
                
                $layGiaBanSP = giaban::where('sp_ma',$sanPham->sp_ma)->where('dv_ma',$sanPham->pivot->dv_ma)->first();
                $dsSPGioHangs[$i][0] = $sanPham->sp_ma;
                $dsSPGioHangs[$i][1] = $sanPham->sp_ten;
                $dsSPGioHangs[$i][2] = $sanPham->sp_hinh;
                $dsSPGioHangs[$i][3] = $sanPham->pivot->soluong;
                $dsSPGioHangs[$i][4] = $layGiaBanSP->donvi->dv_ten; // $layGiaBanSP->dv_ma
                $dsSPGioHangs[$i][5] = ($layGiaBanSP->giaban - ($layGiaBanSP->giaban*$layGiaBanSP->giamgia/100));
                $dsSPGioHangs[$i][6] = $layGiaBanSP->giaban;
                $dsSPGioHangs[$i][7] = $layGiaBanSP->giamgia;
                $sanPham->hoadon()->updateExistingPivot($hoaDonKH->hd_ma, ['giaban'=>$dsSPGioHangs[$i][5], 'giagoc'=>$dsSPGioHangs[$i][6], 'thanhtien'=>$dsSPGioHangs[$i][5]*$dsSPGioHangs[$i][3] ]);
                $dsSPGioHangs[$i][8] = $sanPham->pivot->idspkm;// idspkm
                $dsSPGioHangs[$i][9] = isset($layPhanTramSPKM) ? $layPhanTramSPKM->dv_ma : -1;// don vi sp km
                $dsSPGioHangs[$i][10] = $sanPham->pivot->id;
                $i++;
            }else{
                //dd($sanPham, $sanPham->pivot, $sanPham->pivot->id);
                $iDSPKMs[$sanPham->pivot->sp_ma] = $sanPham->pivot->id;
            }
        }
        if (!empty($maxPhanTrams)) {
            foreach ($maxPhanTrams as $key=>$value) {
                $layGiaSPKM = giaban::where('sp_ma', $key)->where('dv_ma', $dVSPKMs[$key])->first();
                $sanPham = sanpham::where('sp_ma', $key)->first();
                $soLuongSPKM = cthoadon::where('id', $iDSPKMs[$key])->first();
                $dsSPGioHangs[$key][0] = $sanPham->sp_ma;
                $dsSPGioHangs[$key][1] = $sanPham->sp_ten;
                $dsSPGioHangs[$key][2] = $sanPham->sp_hinh;
                $dsSPGioHangs[$key][3] = null; // so luong
                if ($dVSPKMs[$key]==1) {
                    $dsSPGioHangs[$key][4] = ""; // don vi
                } else {
                    $tenDV = donvi::where('dv_ma', $dVSPKMs[$key])->first();
                    $dsSPGioHangs[$key][4] = $tenDV->dv_ten; // don vi
                }
                $dsSPGioHangs[$key][5] = $layGiaSPKM->giaban - ($layGiaSPKM->giaban*$value/100);
                $dsSPGioHangs[$key][6] = $layGiaSPKM->giaban;
                $sanPham->hoadon()->updateExistingPivot($hoaDonKH->hd_ma, ['giaban'=>$dsSPGioHangs[$key][5], 'giagoc'=>$dsSPGioHangs[$key][6], 'thanhtien'=>$dsSPGioHangs[$key][5]*$soLuongSPKM->soluong ]);
                $dsSPGioHangs[$key][7] = $value;
                $dsSPGioHangs[$key][8] = null; // idspkm
                $dsSPGioHangs[$key][9] = $dVSPKMs[$key]; // don vi sp km
                $dsSPGioHangs[$key][10] = $iDSPKMs[$key];
                //$i++;
            }
        }
        //dd( $dsSPGioHangs,$maxPhanTrams, $iDSPKMs );
        if(strcmp($gioHang, 'gioHang')==0){
            //dd($dsSPGioHangs);
            return view('khachhang.thongtin.gioHang', compact('dsSPGioHangs'));
        }
        return view('khachhang.thongtin.donHang', compact('dsSPGioHangs'));
    }

    public function thayDoiSLSPGioHang(Request $request){
        //dd($request);
        $thayDoiSLSPGoc = cthoadon::where('id', $request->iDSPMGoc)->first();
        $soLuongTang = (int)$request->soLuongSPThayDoi - $thayDoiSLSPGoc->soluong;
        $thayDoiSLSPGoc->update(['soluong'=>$request->soLuongSPThayDoi]);

        if($request->iDSPMKM!='-1'){
            $thayDoiSLSPKM = cthoadon::where('id', $request->iDSPMKM)->first();
            $thayDoiSLSPKM->update(['soluong'=>$thayDoiSLSPKM->soluong + $soLuongTang]);
        }
        //return response()->json(['thanhCong'=>'Số lượng sản phẩm đã được cập nhật!', 'iDSPMGoc'=>$request->iDSPMGoc, 'iDSPMKM'=>$request->iDSPMKM, 'soluong'=>$request->soLuongSPThayDoi]);
    }   

    public function xoaSPGocGioHang(Request $request){
        $thayDoiSLSPGoc = cthoadon::where('id', $request->iDSPMGoc)->first();
        if($request->iDSPMKM!='-1') {
            $thayDoiSLSPKM = cthoadon::where('id', $request->iDSPMKM)->first();
            if($request->soLuongSPThayDoi < $thayDoiSLSPKM->soluong){
                $thayDoiSLSPKM->update(['soluong'=>$thayDoiSLSPKM->soluong - (int)$request->soLuongSPThayDoi]);   
            }else{
                $thayDoiSLSPKM->delete();
            }
        } 
        $thayDoiSLSPGoc->delete();
        //return response()->json(['thanhCong'=>'Sản phẩm khuyến mãi được xóa!', 'iDSPMGoc'=>$request->iDSPMGoc, 'iDSPMKM'=>$request->iDSPMKM, 'soluong'=>$request->soLuongSPThayDoi]);
    }

    public function xoaSPKMGioHang(Request $request){
        $thayDoiSLSPGoc = cthoadon::where('id', $request->iDSPMGoc)->first();
        $thayDoiSLSPGoc->update(['idspkm'=>-1]);
        $timSPCoKhuyenMai = cthoadon::where('sp_ma', $thayDoiSLSPGoc->sp_ma)->where('hd_ma', $thayDoiSLSPGoc->hd_ma)->where('idspkm', '<>', '-1')->where('idspkm', '<>', null)->first();

        if($timSPCoKhuyenMai!=null){
            $timSPCoKhuyenMai->update(['soluong'=>$timSPCoKhuyenMai->soluong + $thayDoiSLSPGoc->soluong]);
            $timSPKM = cthoadon::where('sp_ma', $timSPCoKhuyenMai->idspkm)->where('hd_ma', $thayDoiSLSPGoc->hd_ma)->where('idspkm', null)->first();
            if($timSPKM!=null){
                $timSPKM->update(['soluong'=>$timSPKM->soluong + $thayDoiSLSPGoc->soluong]);
            }
            $thayDoiSLSPGoc->delete();
        }

        $thayDoiSLSPKM = cthoadon::where('id', $request->iDSPMKM)->first();
        if($request->soLuongSPThayDoi < $thayDoiSLSPKM->soluong){
            $thayDoiSLSPKM->update(['soluong'=>$thayDoiSLSPKM->soluong - (int)$request->soLuongSPThayDoi]);   
        }else{
            $thayDoiSLSPKM->delete();
        }

        //return response()->json(['thanhCong'=>'Sản phẩm khuyến mãi được xóa!', 'iDSPMGoc'=>$request->iDSPMGoc, 'iDSPMKM'=>$request->iDSPMKM, 'soluong'=>$request->soLuongSPThayDoi]);
    }
    
    public function xoaHetSPGioHang(Request $request)
    {
        $hoaDonKH = hoadon::where('kh_ma', $request->iDSPKHChiTiet)->where('hd_tinhtrang', 0)->first();
        if($hoaDonKH!=null){
            $hoaDonKH->delete();
        }
        return  redirect()->back();
    }
    
    public function layHetDiaChiKH($iDKH, $errors=false){
        $diaChis = diachi::where('kh_ma', $iDKH)->where('dc_tinhtrang', '1')->get();
        if($errors){
            $thatBai = 'Có lỗi trong quá trình thêm địa chỉ!';
            return view('khachhang.thongtin.diaChi', compact('diaChis','errors', 'thatBai'));
        }
        else return view('khachhang.thongtin.diaChi', compact('diaChis'));
    }

    public function diaChiKH_Get(){
        return view('khachhang.thongtin.diaChi');
    }
    public function diaChiKH(Request $request){
        return HoSoController::layHetDiaChiKH($request->iDSPKHChiTiet);
    }
    
    public function suaDiaChiKh(Request $request){
        $diaChiKH = diachi::where('kh_ma', $request->iDSPKHChiTiet)->where('dc_ma', $request->maDiaChi)->first();
        $diaChiKH->update(['dc_ten'=>$request->diaChiKh, 'dc_tenkh'=>$request->tenKH, 'dc_sdt'=>$request->sdtKh]);
        return HoSoController::layHetDiaChiKH($request->iDSPKHChiTiet);
    }

    public function xoaDiaChiKh(Request $request){
        $diaChiKH = diachi::where('kh_ma', $request->iDSPKHChiTiet)->where('dc_ma', $request->maDiaChi)->first();
        $diaChiKH->update(['dc_tinhtrang'=>'0']);
        return HoSoController::layHetDiaChiKH($request->iDSPKHChiTiet);
    }
    public function themDiaChiKh(Request $request) {
        //dd($request);
        $validator = Validator::make($request->all(),
            [
                'dc_ten'=>'required|max:255',
                'dc_sdt'=>'required|min:10|max:11|exists:diachi',
                'dc_tenkh'=>'required|max:40',
            ],
            [
                'dc_ten.required'=>'Vui lòng nhập địa chỉ',
                'dc_ten.max'=>'Địa chỉ quá dài (< 255 ký tự)',
                'dc_sdt.required'=>'Vui lòng nhập số điện thoại',
                'dc_sdt.min'=>'Số điện thoai ít nhất 10 số',
                'dc_sdt.max'=>'Số điện thoai tối đa 11 số',
                'dc_sdt.exists' => 'Số điện thoại đã tồn tại!',
                'dc_tenkh.required'=>'Vui lòng nhập tên người nhận',
                'dc_tenkh.max'=>'Tên người nhận quá dài (< 255 ký tự)',
            ]
        );
        if($validator->fails()){
            return HoSoController::layHetDiaChiKH($request->kh_ma, $validator->errors());
        }
        $diaChi = diachi::create([
            'dc_ten' => $request->diaChiKh, 
            'dc_sdt' => $request->sdtKh, 
            'dc_tenkh' => $request->tenKH, 
            'kh_ma' => $request->kh_ma, 
        ]);
        if($diaChi){
            return HoSoController::layHetDiaChiKH($request->kh_ma)->with(['thanhCong'=>'Thêm địa chỉ thành công!']);
        }
        return HoSoController::layHetDiaChiKH($request->kh_ma)->with(['thatBai'=>'Thêm địa chỉ thất bại!']);
    }

    public function danhSachDonHang_Get()
    {
        $donHangDaThanhToans = collect();
        $donHangChoXacNhans = collect();
        $donHangDaHuys = collect();
        $toolbar_DanhSachDonHang = 'toolbar_DanhSachDonHang';
        return view('khachhang.thongtin.danhsachdonhang', compact('donHangDaThanhToans', 'donHangChoXacNhans', 'donHangDaHuys', 'donHangDaHuys', 'toolbar_DanhSachDonHang'));
    }

    public function layHetDonHangKH($iDKH) {
        $donHangDaThanhToans = hoadon::where("kh_ma", $iDKH)->where("hd_tinhtrang", '1')->get();
        $donHangChoXacNhans = hoadon::where("kh_ma", $iDKH)->where("hd_tinhtrang", '2')->get();
        $donHangDaHuys = hoadon::where("kh_ma", $iDKH)->where("hd_tinhtrang", '3')->get();
        $toolbar_DanhSachDonHang = 'toolbar_DanhSachDonHang';
        return view('khachhang.thongtin.danhsachdonhang', compact('donHangDaThanhToans', 'donHangChoXacNhans', 'donHangDaHuys', 'toolbar_DanhSachDonHang'));
    }

    public function danhSachDonHang(Request $request)
    {
        return HoSoController::layHetDonHangKH($request->iDSPKHChiTiet);
    }

    public function chiTietDonHang_Get()
    {
        return view('khachhang.thongtin.chitietdonhang');
    }

    public function chiTietDonHang(Request $request)
    {
        $chiTietHoaDon = hoadon::where("kh_ma", $request->iDSPKHChiTiet)->where("hd_ma", $request->iDHDSPKH)->where("hd_tinhtrang", $request->tinhTrangHD)->first();
        if($chiTietHoaDon==null){
            return HoSoController::layHetDonHangKH($request->iDSPKHChiTiet);
        }
        $tinhTrangDH = $request->tinhTrangHD;
        $diaChiKH = $chiTietHoaDon->diachi;
       
        if(isset($request->troVeTrangHuyDH)){
            $troVeTrangHuyDH = $request->troVeTrangHuyDH;
            return view('khachhang.thongtin.chitietdonhang', compact('chiTietHoaDon','diaChiKH', 'tinhTrangDH', 'troVeTrangHuyDH'));
        }
        return view('khachhang.thongtin.chitietdonhang', compact('chiTietHoaDon','diaChiKH', 'tinhTrangDH'));
    }

    public function layHetSPDaHuy($iDKH){
        $donHangDaHuys = hoadon::where("kh_ma", $iDKH)->where("hd_tinhtrang", '3')->get();
        if($donHangDaHuys==null){
            return view('khachhang.thongtin.huydonhang');
        }
        return view('khachhang.thongtin.huydonhang', compact('donHangDaHuys'));
    }

    public function donHangDaHuy_Get()
    {
        return view('khachhang.thongtin.huydonhang');
    }
    
    public function donHangDaHuy(Request $request)
    {
        //dd('donHangDaHuy', $request);
        return HoSoController::layHetSPDaHuy($request->iDSPKHChiTiet);
    }

    public function muaLaiDonHangDaHuy(Request $request)
    {
        //dd('muaLaiDonHangDaHuy', $request);
        $muaLaiDonHang = hoadon::where("kh_ma", $request->iDSPKHChiTiet)->where("hd_ma", $request->iDHDSPKH)->where("hd_tinhtrang", '3')->first();
        if($muaLaiDonHang==null){
            return  redirect()->back()->with(["thatBai"=>'Không thể mua lại đơn hàng này!']);
        }
        $muaLaiDonHang->update(["hd_tinhtrang"=>'0']);
        return HoSoController::tinhTienSP($request->iDSPKHChiTiet, 'gioHang');
    }

    public function huyDonHang_Get()
    {
        
    }
    
    public function huyDonHang(Request $request)
    {
        $huyDonHang = hoadon::where("kh_ma", $request->iDSPKHChiTiet)->where("hd_ma", $request->iDHDSPKH)->where("hd_tinhtrang", '2')->first();
        if($huyDonHang!=null){
            $huyDonHang->update(["hd_tinhtrang"=>'3']);
            foreach($huyDonHang->sanphams as $sanPham){
                $sanPham->update(['sp_soluong'=>$sanPham->sp_soluong + $sanPham->pivot->soluong]);
            }
        }
        return HoSoController::layHetSPDaHuy($request->iDSPKHChiTiet);
    }

    public function choXacNhan_Get(){
        return view('khachhang.thongtin.choXacNhan');
    }

    public function choXacNhan(Request $request){
        return HoSoController::layHetSPChoXacNhan($request->iDSPKHChiTiet);
    }

    
    public function layHetSPChoXacNhan($iDKH){
        $hoaDonKHs = hoadon::where('kh_ma', $iDKH)->where('hd_tinhtrang', 2)->get();
        if($hoaDonKHs==null){
            return view('khachhang.thongtin.choxacnhan');
        }
        return view('khachhang.thongtin.choxacnhan', compact('hoaDonKHs'));
    }
    
    public function danhGiaSoSaoSP(Request $request){
        //dd('danhGiaSoSaoSP', $request);
        $danhGiaSP = danhgia::where('kh_ma', $request->iDSPKHChiTiet)->where('sp_ma', $request->iDSPDonHang)->first();
        $khachHang = khachhang::where('kh_ma', $request->iDSPKHChiTiet)->where('tinhtrang', '1')->first();
        if($danhGiaSP!=null){
            $khachHang->sanpham()->updateExistingPivot($request->iDSPDonHang, ['sosao'=>(int)$request->star]);
        }else {
            $khachHang->sanpham()->attach($request->iDSPDonHang, ['sosao'=>(int)$request->star]);
        }
        return response()->json(['danhGiaThanhCong'=>'Cảm ơn bạn đã đánh giá!']);
        //return response()->json(['danhGiaThanhCong'=>'Cảm ơn bạn đã đánh giá!', 'iDSPKHChiTiet'=>$request->iDSPKHChiTiet, 'iDSPDonHang'=>$request->iDSPDonHang, 'sosao'=>$request->star]);
    }

};