@extends('boCuc')

@section('lienKet-CSS-DauTrang')
<link rel="stylesheet" href="{{ asset('css/main.css') }}" />
<style>
div.stars {
    width: 270px;
    display: inline-block;
}

   
.danhGiaThanhCong{
    /* background-color: red;
    color:#fff;
    position: fixed;
    top: 100px;
    right: 0;
    z-index: 9909;
    transition: all 0.2s linear;
    display: inline-block;
    border-radius: 8px; */
    display: none;
}


@keyframes toLeftRight {
    0%{
      opacity: 1;
        visibility: visible;
    }
    100%{
    opacity: 0;
    visibility: hidden;
    transition: all 0.2s ease;
   }
}

/* .review{
    animation: 5s 3s 1 forwards toLeftRight;

} */

input.star {
    display: none;
}

label.star {
    float: right;
    padding: 10px;
    font-size: 36px;
    color: #444;
    transition: all .2s;
}


label.star.active::before{
    content: '\f005';
    color: #FD4;
    transition: all .25s;
}


label.star:hover {
    color: #FD4;
    transform: rotate(-15deg) scale(1.3);
}

label.star:before {
    content: '\f006';
    font-family: FontAwesome;
}


.starChecked {
    content: '\f006';
    color: #FE7;
    
}
</style>
@endsection

@section('lienKet-JS-DauTrang')
<script src=''></script>
@endsection

@section('noiDung')
<section>
    <div class="grid">
        <div class="confirm">
            <div class="wrapper">
                <div class="info">
                    @include('khachhang.menuKh')

                    <script>
                    $(document).ready(function() {
                        $('.menu_lichSuMuaHang').addClass('active');
                    });
                    </script>

                    <div class="info__general w-full">
                        <div class="container mb-4">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="card h-100">
                                        <div
                                            class="card-header bg-white d-flex flex-wrap justify-content-center align-items-center flex-column">

                                            <div class="order__info">
                                                <div class="order__info-content">
                                                    @if(isset($troVeTrangHuyDH))
                                                    <a class="order__info-item borderr" href="#"
                                                        onclick="$('#formIDKHChoXacNhan').trigger('submit');">Trở
                                                        Về</a>
                                                    @else
                                                    <a class="order__info-item borderr" href="#"
                                                        onclick="$('#formIDKHTatCaDonHang').trigger('submit');">Trở
                                                        Về</a>
                                                    @endif
                                                </div>

                                                <div class="danhGiaThanhCong"></div>

                                                <div class="ttinnguoinhan">
                                                    <h3>Địa chỉ nhận hàng</h3>
                                                    <p style="font-size: 16px;">Người đặt hàng: {{$diaChiKH->dc_tenkh}}
                                                    </p>
                                                    <p>Số điện thoại: {{$diaChiKH->dc_sdt}}</p>
                                                    <p>Địa chỉ: {{$diaChiKH->dc_ten}}</p>
                                                </div>
                                                <div class="chitietdonhang">
                                                    <div class="chitietdonhang__id">
                                                        <p>ID đơn hàng:
                                                            {{$chiTietHoaDon->hd_ma.$chiTietHoaDon->dc_ma.$chiTietHoaDon->hd_tinhtrang.$chiTietHoaDon->kh_ma.$chiTietHoaDon->tt_ma.$chiTietHoaDon->vc_ma}}SPKH
                                                        </p>
                                                        <span>{{$chiTietHoaDon->hd_ngaytt}}</span>

                                                    </div>
                                                    @php
                                                    $tongTien = 0;
                                                    @endphp

                                                    @foreach($chiTietHoaDon->sanphams as $sanPham)
                                                    <div class="order__info-product">
                                                        <div class="order__info-product-img">
                                                            <a href="#" style="text-decoration:none;">
                                                                <img src="{{asset('uploads/'.$sanPham->sp_hinh)}}"
                                                                    alt="Ảnh" />
                                                                @if(strcmp($tinhTrangDH,'1')==0)
                                                                <button id="danhGiaSPHD{{$sanPham->sp_ma}}"
                                                                    style="  margin-top: 10px;width: 100px !important;margin-left: 0;"
                                                                    class="btn btn-primary btn-w review1">Đánh giá</button>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="order__info-status">
                                                            <div class="order__info-para">
                                                                @php

                                                                $donVi = App\Models\donvi::where('dv_ma',
                                                                $sanPham->pivot->dv_ma)->first();
                                                                $tongTien += $sanPham->pivot->thanhtien;
                                                                @endphp

                                                                <h3>{{$sanPham->sp_ten.' - '. $donVi->dv_ten.' - '.$sanPham->sp_ma}}
                                                                </h3>
                                                                <p> Số lượng: {{$sanPham->pivot->soluong}} </p>
                                                            </div>

                                                            <div class="order__info-price">
                                                                <!-- <span class="text__deco">230.000đ</span> -->
                                                                <p>Thành tiền: <span
                                                                        class="borderr">{{number_format($sanPham->pivot->thanhtien,0,".",".")}}đ</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="myModal{{$sanPham->sp_ma}}" class="modals">
                                                        <div class="modals-content">
                                                            <span id="dongModalSP{{$sanPham->sp_ma}}"
                                                                class="close">&times;</span>
                                                            <p>Bạn có muốn đánh giá không?</p>
                                                            <!-- <div class="stars"> -->

                                                            <form accept-charset='UTF-8' class="form-sao" id="formSoSao{{$sanPham->sp_ma}}"> 
                                                            <!-- method='post' action="{{route('khachHang.hoSo.danhGiaSoSaoSP')}}" -->
                                                                @csrf

                                                                <div class="form-group">
                                                                    <input type="hidden" name="iDSPKHChiTiet"
                                                                        class="form-control"
                                                                        value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                                                                    <input type="hidden" name="iDSPDonHang"
                                                                        class="form-control"
                                                                        value="{{$sanPham->sp_ma}}" />
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                    <input class="star star-5 form-check-input"
                                                                        id="star-5{{$sanPham->sp_ma}}" type="radio"
                                                                        name="star{{$sanPham->sp_ma}}" value="1" />
                                                                    <label class="star star-5 form-check-label"
                                                                        for="star-5{{$sanPham->sp_ma}} "id="1" data-id="sao"></label>
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                    <input class="star star-4 form-check-input"
                                                                        id="star-4{{$sanPham->sp_ma}}" type="radio"
                                                                        name="star{{$sanPham->sp_ma}}" value="2" />
                                                                    <label class="star star-4 form-check-label"
                                                                        for="star-4{{$sanPham->sp_ma}}" id="2" data-id="sao"></label>
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                    <input class="star star-3 form-check-input"
                                                                        id="star-3{{$sanPham->sp_ma}}" type="radio"
                                                                        name="star{{$sanPham->sp_ma}}" value="3" />
                                                                    <label class="star star-3 form-check-label"
                                                                        for="star-3{{$sanPham->sp_ma}}" id="3"></label>
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                    <input class="star star-2 form-check-input"
                                                                        id="star-2{{$sanPham->sp_ma}}" type="radio"
                                                                        name="star{{$sanPham->sp_ma}}" value="4" />
                                                                    <label class="star star-2 form-check-label"
                                                                        for="star-2{{$sanPham->sp_ma}}" id="4"></label>
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                    <input class="star star-1 form-check-input"
                                                                        id="star-1{{$sanPham->sp_ma}}" type="radio"
                                                                        name="star{{$sanPham->sp_ma}}" value="5" />
                                                                    <label class="star star-1 form-check-label"
                                                                        for="star-1{{$sanPham->sp_ma}}" id="5" ></label>
                                                                </div>

                                                                <button id="submitSoSao{{$sanPham->sp_ma}}" class="btn-rating save-review">Lưu đánh
                                                                    giá</button>
                                                            </form>
                                                            <!-- </div> -->
                                                        </div>
                                                    </div>

                                                    <script>
                                                        



                                                    $(document).ready(function() {
                                                        $('#danhGiaSPHD{{$sanPham->sp_ma}}').click(function() {
                                                            $('#myModal{{$sanPham->sp_ma}}').show();
                                                        });
                                                        $('#dongModalSP{{$sanPham->sp_ma}}').click(function() {
                                                            $('#myModal{{$sanPham->sp_ma}}').hide();
                                                        });

                                                        $('#submitSoSao{{$sanPham->sp_ma}}').click(function(e) {
                                                            e.preventDefault();

                                                            $.ajax({
                                                                url: "{{asset('khachHang/hoSo/danhGiaSoSaoSP')}}",
                                                                type:"POST",
                                                                data:{
                                                                    iDSPKHChiTiet: '{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}',
                                                                    iDSPDonHang:'{{$sanPham->sp_ma}}',
                                                                    star:$('input[name="star{{$sanPham->sp_ma}}"]:checked').length > 0 ? $('input[name="star{{$sanPham->sp_ma}}"]:checked').val(): 1,
                                                                    _token: '{{ csrf_token() }}'
                                                                } ,
                                                                success:function(response){
                                                                    /* console.log(response); */
                                                                    if(response) {
                                                                        $('.danhGiaThanhCong').text(response.danhGiaThanhCong);
                                                                    }
                                                                }/* , 
                                                                error: function(error) {
                                                                    console.log(error);
                                                                } */
                                                            });

                                                            $('#myModal{{$sanPham->sp_ma}}').hide();
                                                        });
                                                            
                                                    });
                                                    </script>

                                                    @endforeach
                                                    <div class="watting__confirm">
                                                        <div class="total__price">
                                                            <p>Tổng tiền phải thanh toán:</p>
                                                            <span>{{number_format($tongTien,0,".",".")}}đ</span>
                                                        </div>
                                                        <div class="ptthanhtoan">
                                                            <p>Phương thức thanh toán:
                                                                <i>{{$chiTietHoaDon->thanhtoan->tt_ten}}</i>
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
</section>
@endsection

@section('lienKet-JS-CuoiTrang')
<script src="{{ asset('') }}"></script>
<script>
    
</script>

@endsection



<!-- <style>

.review{
    display: inline-block;
    padding: 5px 10px;
    background-color: red;
    text-decoration: none;
    color:#fff;
    border-radius: 8px;
    display: none;
}
.review:hover{
    background-color: #fff;
    color:#000;
    border: 1px solid red;
}
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
.form-group input.star:checked ~ .form-group label.star:before {
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

</style> -->