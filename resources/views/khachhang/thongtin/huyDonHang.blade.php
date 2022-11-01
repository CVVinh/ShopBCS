@extends('khachhang.boCucSP')

@section('lienKet-CSS-DauTrang')
<link rel="stylesheet" href="" />
@endsection

@section('lienKet-JS-DauTrang')
<script src=''></script>
@endsection

@section('noiDungSanPham')
<section>
    <div class="order__info">

        <div class="order__confirm">
            <p>ĐÃ HỦY</p>
        </div>
        
        @if(isset($donHangDaHuys) )
        <script>
        $(document).ready(function() {
            $('.toolbar_DaHuy').addClass('borderr');
            $('.menu_lichSuMuaHang').addClass('active');
        });
        </script>
        @endif

        @if(isset($donHangDaHuys))
        @if($donHangDaHuys->isEmpty())
        <div class="empty-cart">
            <img src="{{asset('uploads/gioHangRong.png')}}" alt="Đơn hàng">
            <span>Đơn hàng rỗng!</span>
            <a href="/">Tiếp tục mua hàng</a>
        </div>
        @else
        @foreach($donHangDaHuys as $hoaDon)
        <div class="order__info-product">
            <div class="order__info-ct">
            <div class="order__info-product-img">
                <a href="#">
                    <img src="{{asset('uploads/'.$hoaDon->sanphams[0]->sp_hinh)}}" alt="Ảnh" />
                </a> 
            </div>

                <div class="order__info-para">
                    <h3>Đơn hàng đã hủy</h3>
                    <p>
                        Đơn hàng {{$hoaDon->hd_ma.$hoaDon->dc_ma.$hoaDon->hd_tinhtrang.$hoaDon->kh_ma.$hoaDon->tt_ma.$hoaDon->vc_ma}}SPKH đã được hủy bởi bạn
                    </p>
                    <p>{{$hoaDon->updated_at}}</p>
                </div>
            </div>
            <div class="order__info-dt">
                <div class="order__info-price">
                    <!-- <span class="text__deco">230.000đ</span> -->
                    <span class="borderr">{{number_format($hoaDon->hd_tongtien,0,".",".")}}đ</span>
    
                </div>
                <div class="order__info-price">
                    <form accept-charset='UTF-8' method='post' action="{{route('khachHang.hoSo.muaLaiDonHangDaHuy')}}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                            <input type="hidden" name="iDHDSPKH" class="form-control"
                                value="{{$hoaDon->hd_ma}}" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-w">Mua lại</button>
                    </form>
                </div>
            </div>  
        </div>
        @endforeach
        @endif
        @else
        <div class="empty-cart">
            <img src="{{asset('uploads/gioHangRong.png')}}" alt="Đơn hàng">
            <span>Đơn hàng rỗng!</span>
            <a href="/">Tiếp tục mua hàng</a>
        </div>
        @endif
        <script>
            function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82 || (e.which || e.keyCode) == 123 || (e.which || e.keyCode) == 154) e.preventDefault(); e.stopPropagation(); $('#formIDKHDonHangDaHuy').trigger('submit');};
            $(document).on("keydown", disableF5);
        </script>
    </div>
</section>
@endsection

@section('lienKet-JS-CuoiTrang')
<script src="{{ asset('') }}"></script>

@endsection