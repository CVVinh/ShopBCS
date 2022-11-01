<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sanpham\SaleController;
use App\Http\Controllers\caidat\BangQCController;

use App\Http\Controllers\HoaDon\HoaDonController;

use App\Http\Controllers\sanpham\ComboController;

use App\Http\Controllers\KhachHang\HoSoController;
use App\Http\Controllers\sanpham\SanphamController;
use App\Http\Controllers\XacThuc\TaiKhoanController;
use App\Http\Controllers\danhmucdulieu\NSXController;
use App\Http\Controllers\sanpham\KhuyenMaiController;
use App\Http\Controllers\XacThuc\XacThucFBGController;

use App\Http\Controllers\caidat\ThongTinShopController;

use App\Http\Controllers\danhmucdulieu\DonViController;
use App\Http\Controllers\KhachHang\ChiTietSPController;
use App\Http\Controllers\phieunhap\PhieuNhapController;

use App\Http\Controllers\taikhoan\TaiKhoanKHController;
use App\Http\Controllers\taikhoan\TaiKhoanNVController;
use App\Http\Controllers\XacThuc\QuenMatKhauController;

use App\Http\Controllers\danhmucdulieu\LoaiSPController;
use App\Http\Controllers\nguoidung\NguoiDungKHController;
use App\Http\Controllers\nguoidung\NguoiDungNVController;
use App\Http\Controllers\danhmucdulieu\DanhMucSPController;
use App\Http\Controllers\danhmucdulieu\VanChuyenController;
use App\Http\Controllers\danhmucdulieu\PhuongThucTTController;


// dang nhap khach hang
Route::get('/', [TaiKhoanController::class, 'trangChu'])->name('trangChu');
Route::get('dangNhap', [TaiKhoanController::class, 'dangNhap'])->name('dangNhap.get');
Route::post('dangNhap', [TaiKhoanController::class, 'dangNhapPost'])->name('dangNhap.post');
Route::get('dangKy', [TaiKhoanController::class, 'dangKy'])->name('dangKy.get');
Route::post('dangKy', [TaiKhoanController::class, 'dangKyPost'])->name('dangKy.post');
Route::get('dangXuat', [TaiKhoanController::class, 'dangXuat'])->name('dangXuat');

// dang nhap bang email/facebook
Route::get('/auth/{provider}', [XacThucFBGController::class,'dieuHuongDenNCC',]);
Route::get('/auth/{provide}/callback', [XacThucFBGController::class,'xulyCacLoaiDangNhap',]);
Route::get('searchsp', [SanphamController::class, 'searchsp']);

// kich hoat khach hang
Route::get('nguoiDung/kichHoat/{token}', [TaiKhoanController::class,'kichHoatKhachHang',])->name('nguoiDung.kichHoat');

Route::get('quenMatKhau', [QuenMatKhauController::class, 'quenMatKhau'])->name('quenMatKhau.get');
Route::post('quenMatKhau', [QuenMatKhauController::class,'quenMatKhauPost',])->name('quenMatKhau.post');
Route::get('datLaiMatKhau/{token}', [QuenMatKhauController::class,'datLaiMatKhau',])->name('datLaiMatKhau.get');
Route::post('datLaiMatKhau', [QuenMatKhauController::class,'datLaiMatKhauPost',])->name('datLaiMatKhau.post');
Route::post('datLaiMatKhauBangDienThoai', [QuenMatKhauController::class,'datLaiMatKhauBangDienThoai',])->name('datLaiMatKhauBangDienThoai.post');

// xu ly khach hang da dang nhap
Route::prefix('khachHang')->namespace('khachHang')->name('khachHang.')->middleware('checkLoginKH')->group(function (){
    Route::prefix('thongTinSP')->namespace('thongTinSP')->name('thongTinSP.')->group(function () {
        Route::POST('/themSPGioHang', [ChiTietSPController::class, 'themSPGioHang'])->name('themSPGioHang');
        Route::POST('/them1BoSPGioHang', [ChiTietSPController::class, 'them1BoSPGioHang'])->name('them1BoSPGioHang');
    });

    Route::prefix('hoSo')->namespace('hoSo')->name('hoSo.')->group(function () {
        Route::GET('/hoSoCaNhan', [HoSoController::class, 'hoSoCaNhan'])->name('hoSoCaNhan');
        Route::POST('/hoSoCaNhan', [HoSoController::class, 'capNhatHoSo'])->name('capNhatHoSo');
        Route::GET('/donHang', [HoSoController::class, 'donHang_Get'])->name('donHang_Get');
        Route::POST('/donHang', [HoSoController::class, 'donHang'])->name('donHang');
        Route::POST('/thanhToanDonHang', [HoSoController::class, 'thanhToanDonHang'])->name('thanhToanDonHang');
        Route::GET('/gioHang', [HoSoController::class, 'gioHang_Get'])->name('gioHang_Get');
        Route::POST('/gioHang', [HoSoController::class, 'gioHang'])->name('gioHang');
        Route::GET('/danhSachDonHang', [HoSoController::class, 'danhSachDonHang_Get'])->name('danhSachDonHang_Get');
        Route::POST('/danhSachDonHang', [HoSoController::class, 'danhSachDonHang'])->name('danhSachDonHang');
        Route::GET('/chiTietDonHang', [HoSoController::class, 'chiTietDonHang_Get'])->name('chiTietDonHang_Get');
        Route::POST('/chiTietDonHang', [HoSoController::class, 'chiTietDonHang'])->name('chiTietDonHang');
        Route::GET('/huyDonHang', [HoSoController::class, 'huyDonHang_Get'])->name('huyDonHang_Get');
        Route::POST('/huyDonHang', [HoSoController::class, 'huyDonHang'])->name('huyDonHang');
        Route::GET('/donHangDaHuy', [HoSoController::class, 'donHangDaHuy_Get'])->name('donHangDaHuy_Get');
        Route::POST('/donHangDaHuy', [HoSoController::class, 'donHangDaHuy'])->name('donHangDaHuy');
        Route::POST('/muaLaiDonHang', [HoSoController::class, 'muaLaiDonHangDaHuy'])->name('muaLaiDonHangDaHuy');
        Route::GET('/choXacNhan', [HoSoController::class, 'choXacNhan_Get'])->name('choXacNhan_Get');
        Route::POST('/choXacNhan', [HoSoController::class, 'choXacNhan'])->name('choXacNhan');
        Route::POST('/danhGiaSoSaoSP', [HoSoController::class, 'danhGiaSoSaoSP'])->name('danhGiaSoSaoSP');
        
        Route::POST('/thayDoiSLSPGioHang', [HoSoController::class, 'thayDoiSLSPGioHang'])->name('thayDoiSLSPGioHang');
        Route::POST('/xoaSPKMGioHang', [HoSoController::class, 'xoaSPKMGioHang'])->name('xoaSPKMGioHang');
        Route::POST('/xoaSPGocGioHang', [HoSoController::class, 'xoaSPGocGioHang'])->name('xoaSPGocGioHang');
        Route::POST('/xoaHetSPGioHang', [HoSoController::class, 'xoaHetSPGioHang'])->name('xoaHetSPGioHang');
        Route::GET('/diaChiKH', [HoSoController::class, 'diaChiKH_Get'])->name('diaChiKH_Get');
        Route::POST('/diaChiKH', [HoSoController::class, 'diaChiKH'])->name('diaChiKH');
        Route::POST('/suaDiaChiKh', [HoSoController::class, 'suaDiaChiKh'])->name('suaDiaChiKh');
        Route::POST('/xoaDiaChiKh', [HoSoController::class, 'xoaDiaChiKh'])->name('xoaDiaChiKh');
        Route::POST('/themDiaChiKh', [HoSoController::class, 'themDiaChiKh'])->name('themDiaChiKh');

        Route::get('searchsp', [SanphamController::class, 'searchsp']);

    });
});

// xu ly khach hang chua dang nhap
Route::prefix('khachHang')->namespace('khachHang')->name('khachHang.')->group(function () {

    Route::prefix('thongTinSP')->namespace('thongTinSP')->name('thongTinSP.')->group(function () {
        Route::GET('/chiTietSP/{id}', [ChiTietSPController::class, 'chiTietSP'])->name('chiTietSP');
        Route::GET('/xemToanBoSP/{idsp}', [ChiTietSPController::class, 'xemToanBoSP'])->name('xemToanBoSP');
        Route::GET('/tinTuc', [ChiTietSPController::class, 'tinTuc'])->name('tinTuc');
        Route::POST('/xemToanBoSP', [ChiTietSPController::class, 'timKiemSP'])->name('timKiemSP');

        Route::get('searchsp', [SanphamController::class, 'searchsp']);

        
    });
});


Route::prefix('admin')->namespace('Admin')->name('admin.')->middleware('checkLogin')->group(function () {
    // Route::get('/',[TaiKhoanController::class, 'trangChuQuanLy'])->name('trangChuQuanLy');

    Route::get('/', function () {
        return view('admin.index');
    });
    Route::prefix('sanpham')->namespace('Sanpham')->name('sanpham.')->group(function () {
        Route::GET('hienthi', [SanphamController::class, 'index'])->name('hienthi');
        Route::GET('them', [SanphamController::class, 'create'])->name('them');
        Route::GET('sua/{id}', [SanphamController::class, 'edit'])->name('sua');
        Route::GET('xoa/{id}', [SanphamController::class, 'destroy'])->name('xoa');
        Route::POST('them', [SanphamController::class, 'store'])->name('them');
        Route::POST('sua/{id}', [SanphamController::class, 'update'])->name('sua');
        Route::prefix('sale')->namespace('Sale')->name('sale.')->group(function (){
            Route::GET('hienthi', [SaleController::class, 'index'])->name('hienthi');
            Route::GET('them', [SaleController::class, 'create'])->name('them');
            Route::GET('sua/{id}', [SaleController::class, 'edit'])->name('sua');
            Route::POST('sua/{id}', [SaleController::class, 'update'])->name('sua');
            Route::GET('xoa/{id}', [SaleController::class, 'destroy'])->name('xoa');
            Route::POST('them', [SaleController::class, 'store'])->name('them');
        });
        Route::GET('suakm/{id}', [KhuyenMaiController::class, 'edit'])->name('suakm');
        Route::POST('suakm/{id}', [KhuyenMaiController::class, 'update'])->name('suakm');

        Route::GET('suacombo/{id}', [ComboController::class, 'edit'])->name('suacombo');
        Route::POST('suacombo/{id}', [ComboController::class, 'update'])->name('suacombo');
    }); 
    Route::prefix('danhmucdulieu')->namespace('Danhmucdulieu')->name('danhmucdulieu.')->group(function (){
        Route::prefix('danhmucsp')->namespace('Danhmucsp')->name('danhmucsp.')->group(function (){
            Route::GET('hienthi',[DanhMucSPController::class,'index'])->name('hienthi');
            Route::POST('them',[DanhMucSPController::class,'store'])->name('them');
            Route::GET('xoa/{id}',[DanhMucSPController::class,'destroy'])->name('xoa');
        });
        Route::prefix('loaisanpham')->namespace('Loaisanpham')->name('loaisanpham.')->group(function (){
            Route::GET('hienthi',[LoaiSPController::class,'index'])->name('hienthi');
            Route::POST('them',[LoaiSPController::class,'store'])->name('them');
            Route::GET('xoa/{id}',[LoaiSPController::class,'destroy'])->name('xoa');
        });
        Route::prefix('donvi')->namespace('Donvi')->name('donvi.')->group(function (){
            Route::GET('hienthi',[DonViController::class,'index'])->name('hienthi');
            Route::POST('them',[DonViController::class,'store'])->name('them');
            Route::GET('xoa/{id}',[DonViController::class,'destroy'])->name('xoa');
        });
        Route::prefix('nhasanxuat')->namespace('Nhasanxuat')->name('nhasanxuat.')->group(function (){
            Route::GET('hienthi',[NSXController::class,'index'])->name('hienthi');
            Route::POST('them',[NSXController::class,'store'])->name('them');
            Route::GET('xoa/{id}',[NSXController::class,'destroy'])->name('xoa');
        });
        Route::prefix('vanchuyen')->namespace('Vanchuyen')->name('vanchuyen.')->group(function (){
            Route::GET('hienthi',[VanChuyenController::class,'index'])->name('hienthi');
            Route::POST('them',[VanChuyenController::class,'store'])->name('them');
            Route::GET('xoa/{id}',[VanChuyenController::class,'destroy'])->name('xoa');
        });
        Route::prefix('phuongthucthanhtoan')->namespace('Phuongthucthanhtoan')->name('phuongthucthanhtoan.')->group(function (){
            Route::GET('hienthi',[PhuongThucTTController::class,'index'])->name('hienthi');
            Route::POST('them',[PhuongThucTTController::class,'store'])->name('them');
            Route::GET('xoa/{id}',[PhuongThucTTController::class,'destroy'])->name('xoa');
        });
    });
    Route::prefix('caidat')->namespace('Caidat')->name('caidat.')->group(function () {
        Route::prefix('bangqc')->namespace('Bangqc')->name('bangqc.')->group(function () {
            Route::GET('hienthi', [BangQCController::class,'index'])->name('hienthi');
            Route::GET('sua/{id}', [BangQCController::class,'edit'])->name('sua');
            Route::POST('sua/{id}', [BangQCController::class,'update'])->name('sua');
            });
        Route::prefix('thongtinshop')->namespace('Thongtinshop')->name('thongtinshop.')->group(function () {
            Route::GET('sua',[ThongTinShopController::class,'edit'])->name('sua');
            Route::POST('sua',[ThongTinShopController::class,'update'])->name('sua');
        });
    });

    Route::prefix('phieunhap')->namespace('Phieunhap')->name('phieunhap.')->group(function () {
            Route::GET('hienthi',[PhieuNhapController::class,'index'])->name('hienthi');
            Route::GET('them',[PhieuNhapController::class,'create'])->name('them');
            Route::POST('them',[PhieuNhapController::class,'store'])->name('them');
            Route::GET('sua/{id}',[PhieuNhapController::class,'edit'])->name('sua');
            Route::POST('sua/{id}',[PhieuNhapController::class,'update'])->name('sua');
    });

    Route::prefix('hoadon')->namespace('Hoadon')->name('hoadon.')->group(function () {
        Route::GET('hienthi',[HoaDonController::class,'index'])->name('hienthi');
        Route::GET('chuaduyet',[HoaDonController::class,'chuaduyet'])->name('chuaduyet');
        Route::GET('chuahoanthanh',[HoaDonController::class,'chuahoanthanh'])->name('chuahoanthanh');
        Route::GET('hoanthanh',[HoaDonController::class,'hoanthanh'])->name('hoanthanh');
        Route::GET('cthoadoncd/{id}',[HoaDonController::class,'cthoadoncd'])->name('cthoadoncd');
        Route::GET('cthoadonht/{id}',[HoaDonController::class,'cthoadonht'])->name('cthoadonht');
        Route::GET('inhoadon/{id}',[HoaDonController::class,'inhoadon'])->name('inhoadon');
        Route::POST('duyet/{id}',[HoaDonController::class,'duyet'])->name('duyet');
        Route::GET('them',[HoaDonController::class,'create'])->name('them');
        Route::POST('them',[HoaDonController::class,'store'])->name('them');
        Route::GET('sua/{id}',[HoaDonController::class,'edit'])->name('sua');
        Route::POST('sua/{id}',[HoaDonController::class,'update'])->name('sua');
    });

    Route::prefix('taikhoan')->namespace('Taikhoan')->name('taikhoan.')->group(function () {
        Route::GET('hienthitkkh',[TaiKhoanKHController::class,'index'])->name('hienthitkkh');
        Route::GET('hienthitknv',[TaiKhoanNVController::class,'index'])->name('hienthitknv');
        Route::GET('themtknv',[TaiKhoanNVController::class,'create'])->name('themtknv');
        Route::POST('themtknv',[TaiKhoanNVController::class,'store'])->name('themtknv');

        Route::GET('viewdoimk/{id}',[TaiKhoanNVController::class,'viewdoimk'])->name('viewdoimk');
        Route::POST('doimk/{id}',[TaiKhoanNVController::class,'doimk'])->name('doimk');

    });
    Route::prefix('nguoidung')->namespace('Nguoidung')->name('nguoidung.')->group(function () {
        Route::GET('danhsachkh',[NguoidungKHController::class,'index'])->name('danhsachkh');
        Route::GET('danhsachnv',[NguoidungNVController::class,'index'])->name('danhsachnv');
        Route::GET('thongtinkh/{id}',[NguoidungKHController::class,'thongtinkh'])->name('thongtinkh');
        Route::GET('thongtinnv/{id}',[NguoidungNVController::class,'thongtinnv'])->name('thongtinnv');
        Route::GET('themnv',[NguoidungNVController::class,'create'])->name('themnv');
        Route::POST('sua/{id}',[NguoidungNVController::class,'update'])->name('sua');
        Route::POST('themnv',[NguoidungNVController::class,'store'])->name('themnv');
    });
});
       

