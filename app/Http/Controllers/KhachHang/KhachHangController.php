<?php

namespace App\Http\Controllers\KhachHang;

use Exception;
use Carbon\Carbon;
use App\Models\sale;
use App\Models\donvi;
use App\Models\loaisp;
use App\Models\sanpham;
use App\Models\danhmucsp;
use App\Models\khachhang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;



class KhachHangController extends Controller
{
    public function hoSo()
    {
        return view('khachhang.hoSo', ['kh' => Auth::guard('kh')->user()]);
    }

    public function capNhatHoSo()
    {
        return view('khachhang.hoSo');
    }
    public function danhSachDonHang()
    {
        return view('khachhang.danhsachdonhang');
    }
    public function chitietdonhang()
    {
        return view('khachhang.chitietdonhang');
    }
    public function huydonhang()
    {
        return view('khachhang.huydonhang');
    }

    public function chiTietSP($id)
    {
        $sanPham = sanpham::where('sp_ma', $id)->first();
        
        $loaiSP = loaisp::where('lsp_ma', $sanPham->lsp_ma)->first();
        $spLienQuans = sanpham::where('lsp_ma', $loaiSP->lsp_ma)->where('sp_ma', '<>', $id)->offset(0)->limit(5)->get();
        $dsGiaBan = [];
        $i = 0;
        foreach ($sanPham->donvis as $donvi) {
            $dsGiaBan[$i][0] = $donvi->dv_ten;
            $dsGiaBan[$i][1] = $donvi->pivot->giaban;
            $dsGiaBan[$i][2] = $donvi->pivot->giamgia;
            $dsGiaBan[$i][3] = $dsGiaBan[$i][1] - ($dsGiaBan[$i][1] * $dsGiaBan[$i][2]) / 100;
            $i++;
        }
       // dd($sanPham);
        return view('sanpham.xemSPChiTiet',compact('sanPham', 'loaiSP', 'dsGiaBan', 'spLienQuans'));
    }

    public function xemToanBoSP($idsp){
        //$malsp = random_int(2,loaisp::all()->count());
        $malsp = random_int(9, 12);
        $deXuatChoBans =  sanpham::where('lsp_ma',$malsp )->offset(0)->limit(9)->get();
        
        if($idsp === "thuonghieu"){
            $sPThuongHieus = loaisp::where('lsp_thuonghieu','<>', '')->where('lsp_thuonghieu','<>', 'Khác')->groupby('lsp_thuonghieu', 'lsp_hinh')->select('lsp_thuonghieu', 'lsp_hinh')->distinct()->get();
            return view('sanpham.xemToanBoSP', compact('sPThuongHieus', 'deXuatChoBans'));
        }
        if($idsp === "flashSale"){
            $spSales = sale::where('sale_tinhtrang','1')->first();
            $xemToanBoSPThuongHieus = $spSales->sanphams;
            $flashSale = "FLASH SALE";
            return view('sanpham.xemToanBoSP', compact('xemToanBoSPThuongHieus', 'flashSale', 'deXuatChoBans'));
        }
        $loaiSPThuongHieu = loaisp::where('lsp_ma', $idsp)->first();
        $layIdDanhMuc = substr($idsp, 7);
        $tenDanhMucSPThuongHieu = danhmucsp::where('dm_ma', $layIdDanhMuc)->first();
        
        if($loaiSPThuongHieu!==null){ // tim kiem loai san pham
            $xemToanBoSPThuongHieus = sanpham::where('lsp_ma',$idsp)->get();
            return view('sanpham.xemToanBoSP', compact('loaiSPThuongHieu','xemToanBoSPThuongHieus', 'deXuatChoBans'));
        }else if($tenDanhMucSPThuongHieu!==null){ // tim kiem danh muc
            $dsLoaiSPs = loaisp::where('dm_ma',$layIdDanhMuc)->get();
            $xemToanBoSPThuongHieus = array();
            
            foreach($dsLoaiSPs as $loaiSPs){
                foreach($loaiSPs->sanpham as $sanpham){
                    $xemToanBoSPThuongHieus[] = $sanpham;
                }
            }
            $tieuDeSanPhamDanhMuc = $tenDanhMucSPThuongHieu->dm_ten;

            $soLuongDM = danhmucsp::all()->count();
            $loaiSPDanhMucKhac = loaisp::where('dm_ma',($layIdDanhMuc+1)%$soLuongDM)->first();
            $deXuatChoBans = sanpham::where('lsp_ma',$loaiSPDanhMucKhac->lsp_ma)->get();
            return view('sanpham.xemToanBoSP', compact('tieuDeSanPhamDanhMuc','xemToanBoSPThuongHieus', 'deXuatChoBans'));
        }else { // tim kiem
            $xemToanBoSPThuongHieus = sanpham::where('sp_ten',$idsp)->orwhere('sp_ten', 'like', "%".$idsp."%")->get();
            return view('sanpham.xemToanBoSP', compact('xemToanBoSPThuongHieus', 'idsp', 'deXuatChoBans'));
        }
    }

    public function timKiemSP(Request $request)
    {
        //$malsp = random_int(2,loaisp::all()->count());
        $malsp = random_int(9, 12);
        $deXuatChoBans =  sanpham::where('lsp_ma',$malsp )->offset(0)->limit(9)->get();

        $tieuDe = "Kết Quả Tìm Kiếm Cho '" . $request->tenSPTimKiem . "'";
        $xemToanBoSPThuongHieus = sanpham::where('sp_ten', $request->tenSPTimKiem)->orwhere('sp_ten', 'like', '%' . $request->tenSPTimKiem .'%')->get();
        return view('sanpham.xemToanBoSP',compact('xemToanBoSPThuongHieus', 'tieuDe', 'deXuatChoBans') );
    }
    public function donHang()
    {
        return view('khachhang.donHang');
    }
    public function gioHang()
    {
        return view('khachhang.gioHang');
    }
    public function tintuc(){
        return view('khachhang.tintuc');
    }
    public function choxacnhan(){
        return view('khachhang.choxacnhan');
    }
}