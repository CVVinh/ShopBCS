@extends('boCuc')

@section('lienKet-CSS-DauTrang')
<link rel="stylesheet" href="{{ asset('css/khachHang.css') }}" />
@endsection

@section('lienKet-JS-DauTrang')
<script src=''></script>
@endsection

@section('noiDung')
<div class="grid khungHienThi">
    <div class="wrapper">
        <div class="info">
            @include('khachhang.menuKh')

            @if(session('thanhCong'))
            <div class="add-to-cart" role="alert">
                {{ session('thanhCong') }}
            </div>
            @endif

            @if(session('thatBai'))
            <div class="add-to-cart" role="alert">
                {{ session('thatBai') }}
            </div>
            @endif

            <script>
            $(document).ready(function() {
                $('.menu_donHangCuaToi').addClass('active');
            });
            </script>

            <div class="info__general w-full">
                <div class="container mb-4">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="card h-100">
                                <form accept-charset='UTF-8' method='post'
                                    action="{{route('khachHang.hoSo.thanhToanDonHang')}}">
                                    @csrf
                                    <div class="card-header bg-white d-flex flex-wrap">

                                        <div class="form-group">
                                            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                                                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                                        </div>
                                        <div class="info__ship">
                                            <i class=" fa fa-chevron-left icon-back" onclick="window.history.back()"
                                                aria-hidden="true"></i>
                                            <div class="ship__detail">
                                                <p class="ship__detail-hd">PlayBoy.vn</p>
                                                <p class="ship__detail-ct">Thông tin giao hàng</p>
                                                <div class="i4__acc">

                                                    @if(auth()->guard('kh')->user() &&
                                                    auth()->guard('kh')->user()->hinh!=null)
                                                    <img src="{{asset('avatar/'.auth()->guard('kh')->user()->hinh)}}"
                                                        class="i4__acc-avt" alt="avatar" />
                                                    @else
                                                    <img src="{{asset('avatar/avatar.png')}}" class="i4__acc-avt"
                                                        alt="avatar" />
                                                    @endif

                                                    <div class="i4__acc-name">
                                                        <p>{{auth()->guard('kh')->user()->ten}}</p>
                                                        <p>{{auth()->guard('kh')->user()->email}}</p>

                                                    </div>
                                                </div>


                                                <div class="feildset">
                                                    <div class="feild">
                                                        <a href="#"
                                                            onclick="$('#formIDKHThemDiaChi').trigger('submit')"><i
                                                                class="fa fa-plus" aria-hidden="true"></i>&nbsp;Thêm địa
                                                            chỉ</a>
                                                        @if(!isset($diaChiKHs) || $diaChiKHs->isEmpty())
                                                        <p class="text-danger">(Bạn vui lòng thêm địa chỉ để tiếp tục thanh toán!)</p>
                                                        @endif
                                                    </div>
                                                    <div class="feild">
                                                        <div class="form-group">
                                                            <label class="feild__lable" for="st__address">Địa chỉ giao
                                                                hàng
                                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                            </label>
                                                            <select class="feild__input pd form-control"
                                                                name="diaChiGiaoHang" id="st__address">
                                                                @if(isset($diaChiKHs))
                                                                @foreach($diaChiKHs as $diaChiKH)
                                                                <option id="diaChi{{$diaChiKH->dc_ma}}"
                                                                    value="{{$diaChiKH->dc_ma}}">{{$diaChiKH->dc_ten}} -
                                                                    {{$diaChiKH->dc_sdt}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="location__shipping">
                                                        <h2 class="change-title">Phương thức vận chuyển</h2>
                                                        <div class="feild">
                                                            <div class="form-group">
                                                                <label class="feild__lable" for="st__address"><span>
                                                                        Chọn
                                                                        phương
                                                                        thức
                                                                    </span>
                                                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                                </label>
                                                                <select
                                                                    class="feild__input pd form-control custom-select"
                                                                    name="phuongThucVanChuyen" id="st__address">
                                                                    @if(isset($phuongThucVanChuyens))
                                                                    @foreach($phuongThucVanChuyens as
                                                                    $phuongThucVanChuyen)
                                                                    <option value="{{$phuongThucVanChuyen->vc_ma}}">
                                                                        {{$phuongThucVanChuyen->vc_ten}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="method__pay">
                                                        <h2 class="method__pay-title">Phương thức thanh toán</h2>
                                                    </div>
                                                    <div class="pay__box">
                                                        @if(isset($phuongThucThanhToans))
                                                        @foreach($phuongThucThanhToans as $phuongThucThanhToan)
                                                        <div class="pay__box-item">
                                                            <div class="form-check">
                                                                <input type="radio" name="radioPhuongThucThanhToan"
                                                                    class="input-check form-check-input"
                                                                    id="phuongThuc{{$phuongThucThanhToan->tt_ma}}"
                                                                    value="{{$phuongThucThanhToan->tt_ma}}" checked />
                                                                <img class="pay__box-img "
                                                                    src="{{asset('uploads/'.$phuongThucThanhToan->tt_hinh)}}"
                                                                    alt="Hình" />
                                                                <label class="form-check-label"
                                                                    for="phuongThuc{{$phuongThucThanhToan->tt_ma}}">
                                                                    <span></span>&nbsp;{{$phuongThucThanhToan->tt_ten}}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list__product">
                                            <span class="product-show-order">Hiển thị thông tin đơn hàng
                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            </span>
                                            {{-- <span class="product-hidden-order">Ẩn thông tin đơn hàng</span> --}}
                                            <div class="product-list--buy">
                                                <p class="ship__detail-ct">Sản phẩm của bạn</p>
                                                @php
                                                $tongTien = 0;
                                                @endphp
                                                @if(isset($hoaDonKH))
                                                @if($hoaDonKH->sanphams->isEmpty())
                                                <div id="gioHangRong" class="empty-cart">
                                                    <img src="{{asset('uploads/gioHangRong.png')}}" alt="Đơn hàng">
                                                    <span>Đơn hàng của bạn đang trống</span>
                                                    <a href="/">Tiếp tục mua hàng</a>
                                                </div>
                                                @else

                                                @foreach($hoaDonKH->sanphams as $sanPham)
                                                <div class="product__pay">
                                                    <div class="product__pay-thum">
                                                        <img class="product__pay-img"
                                                            src="{{asset('uploads/'.$sanPham->sp_hinh)}}" alt="" />
                                                        <span
                                                            class="product__pay-number">{{$sanPham->pivot->soluong}}</span>
                                                    </div>
                                                    @php

                                                    $donVi = App\Models\donvi::where('dv_ma',
                                                    $sanPham->pivot->dv_ma)->first();
                                                    $tongTien += $sanPham->pivot->thanhtien;
                                                    @endphp
                                                    @if(strcmp($donVi->dv_ma, '1')==0)
                                                    <p class="product__pay-title">{{$sanPham->sp_ten}} -
                                                        {{$sanPham->sp_ma}}</p>
                                                    @else
                                                    <p class="product__pay-title">{{$sanPham->sp_ten}} -
                                                        {{$donVi->dv_ten}} - {{$sanPham->sp_ma}}</p>
                                                    @endif
                                                    <p class="product__pay-price">
                                                        {{number_format($sanPham->pivot->thanhtien,0,".",".")}}đ</p>
                                                    <!-- $sanPham->pivot->soluong*$sanPham->pivot->giaban -->
                                                </div>
                                                @endforeach
                                                @endif
                                                @else
                                                <div id="gioHangRong" class="empty-cart">
                                                    <img src="{{asset('uploads/gioHangRong.png')}}" alt="Đơn hàng">
                                                    <span>Đơn hàng của bạn đang trống</span>
                                                    <a href="/">Tiếp tục mua hàng</a>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="product__sale">
                                                <div class="code__sale">
                                                    <div class="code_ctn">
                                                        <svg width="15" height="10" viewBox="0 0 18 14" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M17.3337 5.3335V2.00016C17.3337 1.07516 16.5837 0.333496 15.667 0.333496H2.33366C1.41699 0.333496 0.675326 1.07516 0.675326 2.00016V5.3335C1.59199 5.3335 2.33366 6.0835 2.33366 7.00016C2.33366 7.91683 1.59199 8.66683 0.666992 8.66683V12.0002C0.666992 12.9168 1.41699 13.6668 2.33366 13.6668H15.667C16.5837 13.6668 17.3337 12.9168 17.3337 12.0002V8.66683C16.417 8.66683 15.667 7.91683 15.667 7.00016C15.667 6.0835 16.417 5.3335 17.3337 5.3335ZM15.667 4.11683C14.6753 4.69183 14.0003 5.77516 14.0003 7.00016C14.0003 8.22516 14.6753 9.3085 15.667 9.8835V12.0002H2.33366V9.8835C3.32533 9.3085 4.00033 8.22516 4.00033 7.00016C4.00033 5.76683 3.33366 4.69183 2.34199 4.11683L2.33366 2.00016H15.667V4.11683ZM9.83366 9.50016H8.16699V11.1668H9.83366V9.50016ZM8.16699 6.16683H9.83366V7.8335H8.16699V6.16683ZM9.83366 2.8335H8.16699V4.50016H9.83366V2.8335Z"
                                                                fill="#318DBB"></path>
                                                        </svg>
                                                        <p class="code__slale-ct">Mã giảm giá</p>
                                                    </div>
                                                    <div id="code__sale-item">
                                                        <span>
                                                            <p class="code__sale-label">Giảm 10%</p>
                                                        </span>
                                                        <span>
                                                            <p class="code__sale-label">Giảm 10%</p>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="price-ct">
                                                    <div class="provi__price">
                                                        <p>Tạm tính</p>
                                                        <p>{{number_format($tongTien,0,".",".")}}đ</p>
                                                    </div>
                                                    <div class="tranf__fee">
                                                        <p>Phí vận chuyển</p>
                                                        <p>Miễn phí</p>
                                                    </div>
                                                </div>
                                                <div class="total__price-complete">
                                                    <p>Tổng cộng</p>
                                                    <span>{{number_format($tongTien,0,".",".")}}đ</span>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="thanhTien" class="form-control"
                                                        value="{{$tongTien}}" />
                                                </div>
                                                <div class="complete">
                                                    <a href="#" onclick="$('#formIDKHGioHang').trigger('submit')"><i
                                                            class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Giỏ
                                                        hàng</a>

                                                    <button type="submit" id="hoanTatDonHang" class="btn-complete btn-primary">
                                                        Hoàn tất đơn hàng
                                                    </button>
                                                   
                                                    @if((isset($diaChiKHs) && $diaChiKHs->isEmpty()) || !isset($hoaDonKH))
                                                    <script>
                                                    $(document).ready(function() {
                                                        $('#hoanTatDonHang').attr('disabled','disabled');
                                                    });
                                                    </script>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82 || (e.which || e.keyCode) == 123 || (e.which || e.keyCode) == 154) e.preventDefault(); e.stopPropagation(); $('#formIDKHDonHangCuaToi').trigger('submit');};
        $(document).on("keydown", disableF5);
    </script>
</div>
@endsection

@section('lienKet-JS-CuoiTrang')
<script src="{{ asset('') }}"></script>


@endsection