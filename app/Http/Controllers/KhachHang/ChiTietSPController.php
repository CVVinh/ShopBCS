<?php

namespace App\Http\Controllers\KhachHang;

use Exception;
use Carbon\Carbon;
use App\Models\sale;
use App\Models\donvi;
use App\Models\sp_km;
use App\Models\hinhsp;
use App\Models\hoadon;
use App\Models\loaisp;
use App\Models\sanpham;
use App\Models\voucher;
use App\Models\cthoadon;
use App\Models\danhmucsp;
use App\Models\khachhang;
use App\Models\khuyenmai;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Database\QueryException;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\KhachHang\HoSoController;

class ChiTietSPController extends Controller
{
    public function __construct()
    {
        
    }
    public function tinTuc(){
        return view('khachhang.thongtin.tintuc');
    }

    public function chiTietSP($id)
    {
        $sanPham = sanpham::where('sp_ma', $id)->first();
        $dsHinhSanPhams = hinhsp::where('sp_ma', $sanPham->sp_ma)->where('h_tinhtrang', '1')->get();
        //dd($dsHinhSanPhams);
        $loaiSP = loaisp::where('lsp_ma', $sanPham->lsp_ma)->first();
        $spLienQuans = sanpham::where('lsp_ma', $loaiSP->lsp_ma)->where('sp_ma', '<>', $id)->offset(0)->limit(5)->get();
        $dsGiaBan = [];
        $i = 0;
        foreach ($sanPham->donvis as $donvi) {
            $dsGiaBan[$i][0] = $donvi->dv_ten;
            $dsGiaBan[$i][1] = $donvi->pivot->giaban;
            $dsGiaBan[$i][2] = $donvi->pivot->giamgia;
            $dsGiaBan[$i][3] = $dsGiaBan[$i][1] - ($dsGiaBan[$i][1] * $dsGiaBan[$i][2]) / 100;
            $dsGiaBan[$i][4] = $donvi->dv_ma;
            $i++;
        }
        return view('sanpham.xemSPChiTiet',compact('sanPham', 'loaiSP', 'dsGiaBan', 'spLienQuans','dsHinhSanPhams'));
    }

    public function xemToanBoSP($idsp){
        //$malsp = random_int(2,loaisp::all()->count());
        $malsp = random_int(9, 12);
        $deXuatChoBans =  sanpham::where('lsp_ma',$malsp )->offset(0)->limit(9)->get();
        
        if($idsp === "thuonghieu"){
            $sPThuongHieus = loaisp::where('lsp_thuonghieu','<>', '')->where('lsp_thuonghieu','<>', 'Khác')->groupby('lsp_thuonghieu', 'lsp_hinh')->select('lsp_thuonghieu', 'lsp_hinh')->distinct()->paginate(10); //paginate(10)
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

    public function themSPGioHang(Request $request){
        //dd($request);
        $timHoaDonKH = hoadon::where('kh_ma',$request->iDSPKHChiTiet)->where('hd_tinhtrang','0')->first();
        $soLuongSPThem = 0;

        if($timHoaDonKH==null){
            $hoadon = hoadon::create([
                'kh_ma' => $request->iDSPKHChiTiet,
            ]);
            if(!$hoadon){
                return redirect()->back()->with("thatBai","Lỗi Thêm SP!");
            }
            
            /* $idSanPhamKhuyenMai = cthoadon::where('sp_ma', $request->radioSPChiTiet)->where('hd_ma',$hoadon->hd_ma)->where('dv_ma',$request->donViSPKhuyenMai)->where('idspkm',null)->first();
 */
            if(isset($request->radioSPChiTiet)){
                $hoadon->sanphams()->attach($request->iDSPChiTiet,['soluong'=>$request->soLuongSPChiTiet, 'idspkm'=>$request->radioSPChiTiet, 'dv_ma'=>$request->donViSPChiTiet]);

                $hoadon->sanphams()->attach($request->radioSPChiTiet,['soluong'=>$request->soLuongSPChiTiet,'dv_ma'=>$request->donViSPKhuyenMai]);
            }else{
                $hoadon->sanphams()->attach($request->iDSPChiTiet,['soluong'=>$request->soLuongSPChiTiet, 'idspkm'=>-1, 'dv_ma'=>$request->donViSPChiTiet]);
            }
            $soLuongSPThem = $request->soLuongSPChiTiet*2;
        }else {
            $idSanPhamKhuyenMai = cthoadon::where('sp_ma', $request->radioSPChiTiet)->where('hd_ma',$timHoaDonKH->hd_ma)->where('dv_ma',$request->donViSPKhuyenMai)->where('idspkm',null)->first();
            $timSanPhamGoc = cthoadon::where('sp_ma', $request->iDSPChiTiet)->where('hd_ma', $timHoaDonKH->hd_ma)->where('dv_ma',$request->donViSPChiTiet)->where('idspkm', $request->radioSPChiTiet)->first();
            $timSanPhamGocTonTai = cthoadon::where('sp_ma', $request->iDSPChiTiet)->where('hd_ma', $timHoaDonKH->hd_ma)->where('dv_ma',$request->donViSPChiTiet)->where('idspkm', '-1')->first();
            
            if($timSanPhamGoc==null && $timSanPhamGocTonTai==null){
                if(isset($request->radioSPChiTiet)){
                    $timHoaDonKH->sanphams()->attach($request->iDSPChiTiet,['soluong'=>$request->soLuongSPChiTiet, 'dv_ma'=>$request->donViSPChiTiet, 'idspkm'=>$request->radioSPChiTiet]); 
                }else {
                    $timHoaDonKH->sanphams()->attach($request->iDSPChiTiet,['soluong'=>$request->soLuongSPChiTiet, 'dv_ma'=>$request->donViSPChiTiet, 'idspkm'=>'-1']); 
                }
                $soLuongSPThem += $request->soLuongSPChiTiet;
            }else if($timSanPhamGoc==null && $timSanPhamGocTonTai!=null){
                if(isset($request->radioSPChiTiet)){
                    $timSanPhamGocTonTai->update(['soluong'=>(int)$request->soLuongSPChiTiet + (int)$timSanPhamGocTonTai->soluong, 'idspkm'=>$request->radioSPChiTiet]);
                }else{
                    $timSanPhamGocTonTai->update(['soluong'=>(int)$request->soLuongSPChiTiet + (int)$timSanPhamGocTonTai->soluong, 'idspkm'=>'-1']);
                }
                $soLuongSPThem += $request->soLuongSPChiTiet;
            }else if($timSanPhamGoc!=null && $timSanPhamGocTonTai==null){
                //$timHoaDonKH->sanphams()->updateExistingPivot($request->iDSPChiTiet, ['soluong'=>$request->soLuongSPChiTiet + $timSanPhamGoc->soluong]);
                $timSanPhamGoc->update(['soluong'=>$request->soLuongSPChiTiet + $timSanPhamGoc->soluong]);
                $soLuongSPThem += $request->soLuongSPChiTiet;
            }
            if(isset($request->radioSPChiTiet)){
                if ($idSanPhamKhuyenMai==null && $timSanPhamGoc==null && $timSanPhamGocTonTai==null) {
                    $timHoaDonKH->sanphams()->attach($request->radioSPChiTiet,['soluong'=>$request->soLuongSPChiTiet,'dv_ma'=>$request->donViSPKhuyenMai]);
                    $soLuongSPThem += $request->soLuongSPChiTiet;
                }else if ($idSanPhamKhuyenMai==null && $timSanPhamGoc==null && $timSanPhamGocTonTai!=null){
                    $timHoaDonKH->sanphams()->attach($request->radioSPChiTiet,['soluong'=>$timSanPhamGocTonTai->soluong,'dv_ma'=>$request->donViSPKhuyenMai]);
                    $soLuongSPThem += $timSanPhamGocTonTai->soluong;
                }else if ($idSanPhamKhuyenMai==null && $timSanPhamGoc!=null && $timSanPhamGocTonTai==null){
                    $timHoaDonKH->sanphams()->attach($request->radioSPChiTiet,['soluong'=>$timSanPhamGoc->soluong,'dv_ma'=>$request->donViSPKhuyenMai]);
                    $soLuongSPThem += $timSanPhamGoc->soluong;
                }else if ($idSanPhamKhuyenMai!=null && $timSanPhamGocTonTai!=null && $timSanPhamGoc==null){
                    $idSanPhamKhuyenMai->update(['soluong'=>$timSanPhamGocTonTai->soluong + $idSanPhamKhuyenMai->soluong]);
                    $soLuongSPThem += $timSanPhamGocTonTai->soluong;
                }else if ($idSanPhamKhuyenMai!=null && $timSanPhamGocTonTai==null && $timSanPhamGoc!=null){
                    $idSanPhamKhuyenMai->update(['soluong'=>$request->soLuongSPChiTiet + $idSanPhamKhuyenMai->soluong]);
                    $soLuongSPThem += $request->soLuongSPChiTiet;
                }else {
                    $idSanPhamKhuyenMai->update(['soluong'=>$request->soLuongSPChiTiet + $idSanPhamKhuyenMai->soluong]);
                    $soLuongSPThem += $request->soLuongSPChiTiet;
                }
            }
        }
        if(strcmp($request->inputMuaNgay, 'MuaNgay')!=0){
            return redirect()->back()->with("thanhCong",$soLuongSPThem);
        }
        return HoSoController::tinhToanDonHang($request->iDSPKHChiTiet)->with("thanhCong",$soLuongSPThem);
        
        //return response()->json(['thanhCong'=>'San pham da duoc them vao gio hang!', 'iDSPKHChiTiet'=>$request->iDSPKHChiTiet, 'iDSPChiTiet'=>$request->iDSPChiTiet,'giaBanSPChiTiet'=>$request->giaBanSPChiTiet,'giaGocSPChiTiet'=>$request->giaGocSPChiTiet,'soLuongSPChiTiet'=>$request->soLuongSPChiTiet,'donViSPChiTiet'=>$request->donViSPChiTiet,'radioSPChiTiet'=>$request->radioSPChiTiet,'donViSPKhuyenMai'=>$request->donViSPKhuyenMai,'inputThemGioHang'=>$request->inputThemGioHang]);
    }
    
    public function them1BoSPGioHang(Request $request){
        //dd($request);
        $timHoaDonKH = hoadon::where('kh_ma',$request->iDSPKHChiTiet)->where('hd_tinhtrang','0')->first();
        $soLuongSPThem = 0;
        if($timHoaDonKH==null){
            $hoadon = hoadon::create([
                'kh_ma' => $request->iDSPKHChiTiet,
            ]);
            if(!$hoadon){
                return redirect()->back()->with("thatBai","Lỗi Thêm SP!");
            }
            foreach($request->iDSPComBo as $key=>$value){
                $sPKhuyenMai = khuyenmai::where('sp_ma', $value)->where('km_tinhtrang', '1')->first();
                if($sPKhuyenMai!=null){
                    $timSPKhuyenMai = cthoadon::where('sp_ma', $sPKhuyenMai->sanphams[0]->pivot->sp_ma)->where('hd_ma', $hoadon->hd_ma)->where('idspkm', null)->where('dv_ma', $sPKhuyenMai->sanphams[0]->pivot->dv_ma)->first();
                    
                    $hoadon->sanphams()->attach($value,['soluong'=>1,'idspkm'=>$sPKhuyenMai->sanphams[0]->sp_ma, 'dv_ma'=>$request->dVSPComBo[$value]]);
                    
                    if($timSPKhuyenMai==null){
                        $hoadon->sanphams()->attach($sPKhuyenMai->sanphams[0]->sp_ma,['soluong'=>1, 'dv_ma'=>$sPKhuyenMai->sanphams[0]->pivot->dv_ma]);
                    }else {
                        $timSPKhuyenMai->update(['soluong'=>1+$timSPKhuyenMai->soluong]);
                    }
                }else {
                    $hoadon->sanphams()->attach($value,['soluong'=>1,'idspkm'=>'-1', 'dv_ma'=>$request->dVSPComBo[$value]]);
                }
            }
            $soLuongSPThem = $request->soLuongSPChiTiet*2;
        }else {
            foreach($request->iDSPComBo as $key=>$value){
                $sPKhuyenMai = khuyenmai::where('km_ma', $value)->where('km_tinhtrang', '1')->first();

                $timSanPhamGoc = cthoadon::where('sp_ma', $value)->where('hd_ma', $timHoaDonKH->hd_ma)->where('dv_ma', $request->dVSPComBo[$value])->where('idspkm', $sPKhuyenMai->sanphams[0]->sp_ma)->first();
                $timSanPhamGocTonTai = cthoadon::where('sp_ma', $value)->where('hd_ma', $timHoaDonKH->hd_ma)->where('dv_ma',$request->dVSPComBo[$value])->where('idspkm', '-1')->first();
                
                if($timSanPhamGoc==null && $timSanPhamGocTonTai==null){
                    if($sPKhuyenMai->sanphams[0]!=null){
                        $timHoaDonKH->sanphams()->attach($value,['soluong'=>'1', 'dv_ma'=>$request->dVSPComBo[$value], 'idspkm'=>$sPKhuyenMai->sanphams[0]->sp_ma]); 
                    }else {
                        $timHoaDonKH->sanphams()->attach($value,['soluong'=>'1', 'dv_ma'=>$request->dVSPComBo[$value], 'idspkm'=>'-1']); 
                    }
                }else if($timSanPhamGoc==null && $timSanPhamGocTonTai!=null){
                    $timSanPhamGocTonTai->update(['soluong'=>1 + (int)$timSanPhamGocTonTai->soluong, 'idspkm'=>$sPKhuyenMai->sanphams[0]->sp_ma]);
                }else if($timSanPhamGoc!=null && $timSanPhamGocTonTai==null){
                    $timSanPhamGoc->update(['soluong'=>1 + $timSanPhamGoc->soluong]);
                }
                $soLuongSPThem += 1;

                $timSPKhuyenMai = cthoadon::where('sp_ma', $sPKhuyenMai->sanphams[0]->pivot->sp_ma)->where('hd_ma', $timHoaDonKH->hd_ma)->where('idspkm', null)->where('dv_ma', $sPKhuyenMai->sanphams[0]->pivot->dv_ma)->first();
                
                if ($timSPKhuyenMai==null && $timSanPhamGoc==null && $timSanPhamGocTonTai==null) {
                    $timHoaDonKH->sanphams()->attach($sPKhuyenMai->sanphams[0]->pivot->sp_ma,['soluong'=>1, 'dv_ma'=>$sPKhuyenMai->sanphams[0]->pivot->dv_ma]);
                    $soLuongSPThem += 1;
                }else if ($timSPKhuyenMai==null && $timSanPhamGoc==null && $timSanPhamGocTonTai!=null){
                    $timHoaDonKH->sanphams()->attach($sPKhuyenMai->sanphams[0]->pivot->sp_ma,['soluong'=>$timSanPhamGocTonTai->soluong,'dv_ma'=>$sPKhuyenMai->sanphams[0]->pivot->dv_ma]);
                    $soLuongSPThem += $timSanPhamGocTonTai->soluong;
                }else if ($timSPKhuyenMai==null && $timSanPhamGoc!=null && $timSanPhamGocTonTai==null){
                    $timHoaDonKH->sanphams()->attach($sPKhuyenMai->sanphams[0]->pivot->sp_ma,['soluong'=>$timSanPhamGoc->soluong,'dv_ma'=>$sPKhuyenMai->sanphams[0]->pivot->dv_ma]);
                    $soLuongSPThem += $timSanPhamGoc->soluong;
                }else if ($timSPKhuyenMai!=null && $timSanPhamGocTonTai!=null && $timSanPhamGoc==null){
                    $timSPKhuyenMai->update(['soluong'=>$timSanPhamGocTonTai->soluong + $timSPKhuyenMai->soluong]);
                    $soLuongSPThem += $timSanPhamGocTonTai->soluong;
                }else if ($timSPKhuyenMai!=null && $timSanPhamGocTonTai==null && $timSanPhamGoc!=null){
                    $timSPKhuyenMai->update(['soluong'=>1 + $timSPKhuyenMai->soluong]);
                    $soLuongSPThem += 1;
                }else {
                    $timSPKhuyenMai->update(['soluong'=>1 + $timSPKhuyenMai->soluong]);
                    $soLuongSPThem += 1;
                }

            }
        }
        return redirect()->back()->with("thanhCong",$soLuongSPThem);
    }

    
    
}