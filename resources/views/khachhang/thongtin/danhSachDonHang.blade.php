@extends('khachhang.boCucSP')

@section('lienKet-CSS-DauTrang')
<link rel="stylesheet" href="" />
@endsection

@section('lienKet-JS-DauTrang')
<script src=''></script>
@endsection

@section('noiDungSanPham')
<section>
    @if($donHangDaThanhToans->isEmpty() && $donHangChoXacNhans->isEmpty() && $donHangDaHuys->isEmpty())
    <div class="empty-cart">
        <img src="{{asset('uploads/gioHangRong.png')}}" alt="Đơn hàng">
        <span>Đơn hàng rỗng!</span>
        <a href="/">Tiếp tục mua hàng</a>
    </div>
    @else
    <div class="order__info">

        <div class="order__confirm">
            <p>ĐƠN HÀNG CỦA BẠN</p>
        </div>

        @if(!$donHangChoXacNhans->isEmpty())
        @foreach($donHangChoXacNhans as $donHangChoXacNhan)
        <div class="order__info-product">
            <div class="order__info-ct">
                <div class="order__info-product-img">
                    <a href="#">
                        <img src="{{asset('uploads/'.$donHangChoXacNhan->sanphams[0]->sp_hinh)}}" alt="Ảnh" />
                    </a>
                </div>
                <div class="order__info-para">
                    <h3>Đơn hàng đang chờ xác nhận</h3>
                    <p> Đơn hàng
                        {{$donHangChoXacNhan->hd_ma.$donHangChoXacNhan->dc_ma.$donHangChoXacNhan->hd_tinhtrang.$donHangChoXacNhan->kh_ma.$donHangChoXacNhan->tt_ma.$donHangChoXacNhan->vc_ma}}SPKH
                        đang trong quá trình xử lý</p>
                    <p>{{$donHangChoXacNhan->hd_ngaytt}}</p>
                </div>
            </div>
            <div class="order__info-dt">
                <div class="order__info-para">
                    <span class="borderr">{{number_format($donHangChoXacNhan->hd_tongtien,0,".",".")}}đ</span>

                </div>
                <div class="order__info-btn">
                    <form accept-charset='UTF-8' method='post' action="{{route('khachHang.hoSo.chiTietDonHang')}}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                            <input type="hidden" name="iDHDSPKH" class="form-control"
                                value="{{$donHangChoXacNhan->hd_ma}}" />
                            <input type="hidden" name="tinhTrangHD" class="form-control"
                                value="{{$donHangChoXacNhan->hd_tinhtrang}}" />
                        </div>
                        <button type="submit" class="btn">Xem chi tiết</button>
                    </form>
                </div>
            </div>

        </div>
        @endforeach
        @endif

        @if(!$donHangDaHuys->isEmpty())
        @foreach($donHangDaHuys as $donHangDaHuy)
        <div class="order__info-product">
            <div class="order__info-ct">
                <div class="order__info-product-img">
                    <a href="#">
                        <img src="{{asset('uploads/'.$donHangDaHuy->sanphams[0]->sp_hinh)}}" alt="Ảnh" />
                    </a>
                </div>
                <div class="order__info-para">
                    <h3>Đơn hàng đã hủy</h3>
                    <p> Đơn hàng
                        {{$donHangDaHuy->hd_ma.$donHangDaHuy->dc_ma.$donHangDaHuy->hd_tinhtrang.$donHangDaHuy->kh_ma.$donHangDaHuy->tt_ma.$donHangDaHuy->vc_ma}}SPKH
                        đã được hủy bởi bạn </p>
                    <p>{{$donHangDaHuy->updated_at}}</p>
                </div>
            </div>
            <div class="order__info-dt">

                <div class="order__info-para">
                    <span class="borderr">{{number_format($donHangDaHuy->hd_tongtien,0,".",".")}}đ</span>
                </div>
                <div class="order__info-btn">
                    <form accept-charset='UTF-8' method='post' action="{{route('khachHang.hoSo.chiTietDonHang')}}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                            <input type="hidden" name="iDHDSPKH" class="form-control"
                                value="{{$donHangDaHuy->hd_ma}}" />
                            <input type="hidden" name="tinhTrangHD" class="form-control"
                                value="{{$donHangDaHuy->hd_tinhtrang}}" />
                        </div>
                        <button type="submit" class="btn">Xem chi tiết</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        @endif

        @if(!$donHangDaThanhToans->isEmpty())
        @foreach($donHangDaThanhToans as $donHangDaThanhToan)
        <div class="order__info-product">
            <div class="order__info-ct">
                <div class="order__info-product-img">
                    <a href="#">
                        <img src="{{asset('uploads/'.$donHangDaThanhToan->sanphams[0]->sp_hinh)}}" alt="Ảnh" />
                    </a>
                </div>

                <div class="order__info-para">
                    <h3>Đơn hàng đã hoàn thành</h3>
                    <p> Đơn hàng
                        {{$donHangDaThanhToan->hd_ma.$donHangDaThanhToan->dc_ma.$donHangDaThanhToan->hd_tinhtrang.$donHangDaThanhToan->kh_ma.$donHangDaThanhToan->tt_ma.$donHangDaThanhToan->vc_ma}}SPKH
                        đã được thanh toán bởi bạn </p>
                    <p>{{$donHangDaThanhToan->updated_at}}</p>
                </div>
            </div>
            <div class="order__info-dt">
                <div class="order__info-para">
                    <span class="borderr">{{number_format($donHangDaThanhToan->hd_tongtien,0,".",".")}}đ</span>
                </div>
                <div class="order__info-btn">
                    <form accept-charset='UTF-8' method='post' action="{{route('khachHang.hoSo.chiTietDonHang')}}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                            <input type="hidden" name="iDHDSPKH" class="form-control"
                                value="{{$donHangDaThanhToan->hd_ma}}" />
                            <input type="hidden" name="tinhTrangHD" class="form-control"
                                value="{{$donHangDaThanhToan->hd_tinhtrang}}" />
                        </div>
                        <button type="submit" class="btn">Xem chi tiết</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        @endif
        @endif
    </div>

    <script>
    $(document).ready(function() {
        $('.toolbar_DanhSachDonHang').addClass('borderr');
        $('.menu_lichSuMuaHang').addClass('active');

        function disableF5(e) {
            if ((e.which || e.keyCode) == 116 || (e.which || e
                    .keyCode) == 82 || (e.which || e.keyCode) == 123 || (e
                    .which || e.keyCode) == 154) e.preventDefault();
            e.stopPropagation();
            $('#formIDKHTatCaDonHang').trigger('submit');
        };
        $(document).on("keydown", disableF5);
    });
    </script>

</section>
@endsection

@section('lienKet-JS-CuoiTrang')
<script src="{{ asset('') }}"></script>


@endsection