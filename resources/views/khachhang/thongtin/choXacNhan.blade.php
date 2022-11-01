@extends('khachhang.boCucSP')

@section('lienKet-CSS-DauTrang')
<link rel="stylesheet" href="" />
<<<<<<< HEAD
<style>
  div.stars {
  width: 270px;
  display: inline-block;
}
input.star { display: none; }
label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}
input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}
input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}
input.star-1:checked ~ label.star:before { color: #F62; }
label.star:hover { transform: rotate(-15deg) scale(1.3); }
label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}

</style>
=======
>>>>>>> 912c47a5366ce2aa5a0cd7f2e076b7f631e0e209
@endsection

@section('lienKet-JS-DauTrang')
<script src=''></script>
@endsection

@section('noiDungSanPham')
<section>
    <div class="order__info">

        <div class="order__confirm">
            <p>CHỜ XÁC NHẬN</p>
        </div>

        @if(isset($hoaDonKHs) )
        <script>
        $(document).ready(function() {
            $('.toolbar_ChoXacNhan').addClass('borderr');
            $('.menu_lichSuMuaHang').addClass('active');
        });
        </script>
        @endif

        @if(isset($hoaDonKHs))
        @if($hoaDonKHs->isEmpty())
        <div id="gioHangRong" class="empty-cart">
            <img src="{{asset('uploads/gioHangRong.png')}}" alt="Đơn hàng">
            <span>Bạn chưa có đơn hàng nào!</span>
            <a href="/">Tiếp tục mua hàng</a>
        </div>
        @else
        @foreach($hoaDonKHs as $hoaDon)
        <div class="order__info-product">
            <div class="order__info-ct">
                <div class="order__info-product-img">
                    <a href="#">
                        <img src="{{asset('uploads/'.$hoaDon->sanphams[0]->sp_hinh)}}" alt="Ảnh" />
                    </a>
                </div>

                <div class="order__info-para">
                    <h3>Đơn hàng đang chờ xác nhận</h3>
                    <p>
                        Đơn hàng
                        {{$hoaDon->hd_ma.$hoaDon->dc_ma.$hoaDon->hd_tinhtrang.$hoaDon->kh_ma.$hoaDon->tt_ma.$hoaDon->vc_ma}}SPKH
                        đang trong quá trình xử lý
                    </p>
                    <p>{{$hoaDon->hd_ngaytt}}</p>
                </div>
            </div>
            <div class="order__info-dt">
                <div class="order__info-price">
                    <!-- <span class="text__deco">230.000đ</span> -->
                    <span class="borderr">{{number_format($hoaDon->hd_tongtien,0,".",".")}}đ</span>

                </div>
                <div class="order__info-price">
                    <form accept-charset='UTF-8' method='post' action="{{route('khachHang.hoSo.huyDonHang')}}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                            <input type="hidden" name="iDHDSPKH" class="form-control" value="{{$hoaDon->hd_ma}}" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-w">Hủy đơn hàng</button>

                    </form>
                    <form accept-charset='UTF-8' method='post' action="{{route('khachHang.hoSo.chiTietDonHang')}}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                            <input type="hidden" name="iDHDSPKH" class="form-control"
                                value="{{$hoaDon->hd_ma}}" />
                            <input type="hidden" name="tinhTrangHD" class="form-control"
                                value="{{$hoaDon->hd_tinhtrang}}" />
                            <input type="hidden" name="troVeTrangHuyDH" class="form-control"
                                value="troVeTrangHuyDH" />
                        </div>
                        <button type="submit" class="btn btn-success btn-w">Xem chi tiết</button>
                    </form>
                </div>
            </div>
        </div>

        @endforeach
        @endif
        @else
        <div id="gioHangRong" class="empty-cart">
            <img src="{{asset('uploads/gioHangRong.png')}}" alt="Đơn hàng">
            <span>Bạn chưa có đơn hàng nào!</span>
            <a href="/">Tiếp tục mua hàng</a>
        </div>
        @endif

        <script>
            function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82 || (e.which || e.keyCode) == 123 || (e.which || e.keyCode) == 154) e.preventDefault(); e.stopPropagation(); $('#formIDKHChoXacNhan').trigger('submit');};
            $(document).on("keydown", disableF5);
        </script>
        
    </div>
</section>

@endsection

@section('lienKet-JS-CuoiTrang')
<script>
// $(document).ready(function() {
//     const modal = document.getElementById("myModal");
//     const btn = document.getElementById("danhGiaSoSao");
//     const span = document.getElementsByClassName("close")[0];
//     if (modal) {
//         btn.addEventListener("click", () => {
//             modal.style.display = "block";
//         })
//     }
//     if (span) {
//         span.addEventListener("click", () => {
//             modal.style.display = "none";
//         })
//     }
//     window.onclick = function(event) {
//         if (event.target == modal) {
//             modal.style.display = "none";
//         }
//     }
// });
</script>

<script src="{{ asset('') }}"></script>

@endsection