@extends('boCuc')
@section('lienKet-CSS-DauTrang')
<link rel="stylesheet" href="{{ asset('css/chiTietSP.css') }}" />
@endsection

@section('lienKet-JS-DauTrang')
<script src=''></script>
@endsection

@section('noiDung')

<div class="container chiTietSP-Top mt-mobile">
    <nav style="--bs-breadcrumb-divider: '>'; margin:20px 0 20px 0" aria-label="breadcrumb">
        <i class=" fa fa-chevron-left icon-back" onclick="window.history.back()" aria-hidden="true"></i>
        @php
        if(strcmp($dsGiaBan[0][4],'1')!=0)
        $tenSPChiTiet = $sanPham->sp_ten.' - '.$dsGiaBan[0][0].' - '.$sanPham->sp_ma;
        else
        $tenSPChiTiet = $sanPham->sp_ten.' - '.$sanPham->sp_ma;
        @endphp
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="nav__link" href="/">Trang Chủ</a></li>
            <li class="breadcrumb-item"><a class="nav__link"
                    href="/khachHang/thongTinSP/xemToanBoSP/{{$loaiSP->lsp_ma}}">{{$loaiSP->lsp_ten}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$tenSPChiTiet}}</li>
        </ol>
    </nav>

    @if(session('thanhCong'))
    <div class="add-to-cart" role="alert">
        +{{ session('thanhCong') }}
    </div>
    @endif

    @if(session('thatBai'))
    <div class="add-to-cart" role="alert">
        {{ session('thatBai') }}
    </div>
    @endif

    <div class="row g-0 mt-md-3 bg-white">
        <div class="col-lg-4 col-12 boder-end">
            <div class="gallery p-lg-3 position-relative">
                <a href="#">
                    <img class="gallery__image-feature" src="{{asset('uploads/'.$sanPham->sp_hinh)}}" alt="Ảnh Mẫu">
                </a>
            </div>
            <div class="mini-img">
                @if(!empty($dsHinhSanPhams))
                @foreach($dsHinhSanPhams as $hinhsp)
                <div class="img-hover">
                    <img src="{{asset('uploads/'.$hinhsp->h_ten)}}" alt="">

                </div>
                @endforeach
                @endif

            </div>

        </div>
        <div class="col-lg-5 col-12 infor">
            <h3 id="tenSP">{{$tenSPChiTiet}}</h3>
            <div class="review">
                @php
                $laySP = App\Models\danhgia::where('sp_ma', $sanPham->sp_ma)->get()->sum('sosao');
                $laySoKH = App\Models\danhgia::where('sp_ma', $sanPham->sp_ma)->count('kh_ma');
                if($laySoKH==0){
                    $soSaoDanhGia = 0;
                }else {
                    $soSaoDanhGia = ceil((float)$laySP/(float)$laySoKH);
                }
                $soSaoChuaDanhGia = 5 - $soSaoDanhGia;
                @endphp

                <div class="icon">
                    @for($i=0; $i<$soSaoDanhGia; $i++) 
                    <i class="fa fa-star" aria-hidden="true"></i>
                    @endfor

                    @for($i=0; $i<$soSaoChuaDanhGia; $i++) 
                    <i class="fa fa-star" aria-hidden="true" style="color:black;"></i>
                    @endfor

                    @php
                    $kiemTraTonKho = App\Models\cthoadon::where('sp_ma',$sanPham->sp_ma)->get()->sum('soluong');
                    @endphp
                    <a href="#"> ({{$laySoKH}} đánh giá) </a> <span> Đã bán {{$kiemTraTonKho}} </span>
                </div>
                <div class="price">
                    <h3 id="giaBanSP">{{number_format($dsGiaBan[0][3])}}đ</h3>
                    <p id="giaGocSP" class=" price__discount text-size">{{ number_format($dsGiaBan[0][1]) }}đ </p>
                    <p id="giamGiaSP" class="text-size badge bg-danger">-{{$dsGiaBan[0][2]}}%</p>
                </div>
                <div class="trademark">
                    <a href=""><img src="{{asset('uploads/banner1.png')}}" alt=""></a>
                    <p class="text-size"> Thương hiệu: <a class="shell" href="">{{$loaiSP->lsp_thuonghieu}}</a></p>
                </div>

                <!-- <script>
                $(document).ready(function() {
                    $('#btnMuaNgay').click(function() {
                        $.ajax({
                            url: "{{asset('khachHang/thongTinSP/themSPGioHang')}}",
                            type: "POST",
                            data: {
                                iDSPKHChiTiet: $('input[name="iDSPKHChiTiet"]').val(),
                                iDSPChiTiet: $('input[name="iDSPChiTiet"]').val(),
                                giaBanSPChiTiet: $('input[name="giaBanSPChiTiet"]').val(),
                                giaGocSPChiTiet: $('input[name="giaGocSPChiTiet"]').val(),
                                soLuongSPChiTiet: $('input[name="soLuongSPChiTiet"]').val(),
                                donViSPChiTiet: $('input[name="donViSPChiTiet"]').val(),
                                radioSPChiTiet: $('input[name=radioSPChiTiet]:checked').length > 0 ? $('input[name=radioSPChiTiet]:checked').val():"-1",
                                donViSPKhuyenMai: $('input[name="donViSPKhuyenMai"]').val(),
                                inputThemGioHang: 'ThemGioHang',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                console.log(response);
                                if(response) {
                                    $('.thanhCong').text(response.thanhCong);
                                    $("#formThemSPGioHang")[0].reset();
                                }
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    });
                });
                </script> -->

                <form accept-charset='UTF-8' id="formThemSPGioHang" class="form-inline" method='post'
                    action="{{route('khachHang.thongTinSP.themSPGioHang')}}">
                    @csrf
                    <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                        value="{{auth()->guard('kh')->user()? auth()->guard('kh')->user()->kh_ma: 0}}">
                    <input type="hidden" name="iDSPChiTiet" class="form-control" value="{{ $sanPham->sp_ma }}">
                    <input type="hidden" name="giaBanSPChiTiet" class="form-control" value="{{$dsGiaBan[0][3]}}">
                    <input type="hidden" name="giaGocSPChiTiet" class="form-control" value="{{ $dsGiaBan[0][1] }}">
                    <input type="hidden" name="soLuongSPChiTiet" class="form-control" value="1">
                    <input type="hidden" name="donViSPChiTiet" class="form-control" value="{{$dsGiaBan[0][4]}}">
                    <input type="hidden" name="donViSPKhuyenMai" class="form-control" value="-1">
                    <input type="hidden" name="inputMuaNgay" class="form-control" value="MuaNgay">
                    @php
                    $sPKhuyenMais=
                    App\Models\khuyenmai::where('sp_ma',$sanPham->sp_ma)->where('km_tinhtrang',1)->first();
                    @endphp
                    @if($sPKhuyenMais)
                    <div class="promotion justify-content-between">
                        <div class="promotion__icon">
                            <img src="{{asset('uploads/gift.svg')}}" alt="">
                            <span class="text-size">Khuyến Mãi</span>
                        </div>
                        <div class="icon-dropdown">
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div class="accordion-body border accordion-show show">
                        @foreach($sPKhuyenMais->sanphams as $sPKhuyenMai)
                        @php
                        $kiemTraTonKho = App\Models\cthoadon::where('sp_ma',$sPKhuyenMai->sp_ma)->get()->sum('soluong');
                        @endphp
                        @if($sPKhuyenMai->sp_soluong > 0)
                        <div class="buyxgety_item row align-items-center gx-3 mx-0">
                            <div class="col-auto form-check">
                                <input class="form-check-input" type="radio" name="radioSPChiTiet"
                                    id="radio{{$sPKhuyenMai->sp_ma}}" value="{{$sPKhuyenMai->sp_ma}}">
                                <script>
                                $('#radio{{$sPKhuyenMai->sp_ma}}').click(function() {
                                    $('input[name="donViSPKhuyenMai"]').val('{{$sPKhuyenMai->pivot->dv_ma}}');
                                });
                                </script>
                            </div>
                            <div class="col-auto border-end border-start">
                                <div class="ratio ratio-1x1">
                                    <a class="text-decoration-none"
                                        href="/khachHang/thongTinSP/chiTietSP/{{$sPKhuyenMai->sp_ma}}">
                                        <img class="img" src="{{asset('uploads/'.$sPKhuyenMai->sp_hinh)}}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col small ">
                                @if(strcmp($sPKhuyenMai->donvis[0]->dv_ma, '1')!=0)
                                {{$sPKhuyenMai->pivot->mota}}
                                <strong class="text-danger">{{$sPKhuyenMai->pivot->phantram}}% </strong>
                                {{$sPKhuyenMai->sp_ten.' - '.$sPKhuyenMai->donvis[0]->dv_ten.' - '.$sPKhuyenMai->sp_ma}}
                                @else
                                {{$sPKhuyenMai->pivot->mota}}
                                <strong class="text-danger">{{$sPKhuyenMai->pivot->phantram}}% </strong>
                                {{$sPKhuyenMai->sp_ten.' - '.$sPKhuyenMai->sp_ma}}
                                @endif
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                </form>

                @if(strcmp($dsGiaBan[0][4],"1")!=0)
                <h4 class="title">Tiêu đề:</h4>
                <div class="button_box">
                    @php
                    $idBtn = 1;
                    @endphp
                    @foreach($dsGiaBan as $giaBan)
                    <button class="donVi" id="donVi{{$idBtn}}">{{$giaBan[0]}}</button>
                    <script>
                    $(document).ready(function() {
                        $('#donVi{{$idBtn}}').click(function() {
                            $('#giaGocSP').text('{{ number_format($giaBan[1]) }}đ');
                            $('input[name="giaGocSPChiTiet"]').val('{{ $giaBan[1] }}');
                            $('#giamGiaSP').text('-{{ $giaBan[2] }}%');
                            $('#giaBanSP').text('{{ number_format($giaBan[3]) }}đ');
                            $('input[name="giaBanSPChiTiet"]').val('{{ $giaBan[3] }}');
                            $('input[name="donViSPChiTiet"]').val('{{ $giaBan[4] }}');
                        });
                    });
                    </script>
                    @php
                    $idBtn++;
                    @endphp

                    @endforeach
                </div>
                @endif

                <div class="amount">
                    <div id="chonSLSanPhamMua">
                        <button id="btnGiamSL" class="text-size" disabled> - </button>
                        <button id="btnHienSL" class="text-size button_amount">1</button>
                        <button id="btnTangSL" class="text-size"> + </button>
                    </div>
                    @if($sanPham->sp_soluong > 0)
                        <p class="text-size">Còn Hàng</p>
                        <script>
                        $(document).ready(function() {
                            $("#chonSLSanPhamMua *").prop('disabled', false);
                            $(".button_buy *").prop('disabled', false);
                        });
                        </script>
                        @else
                        <p class="text-size">Hết Hàng</p>
                        <script>
                        $(document).ready(function() {
                            $("#chonSLSanPhamMua *").prop('disabled', true);
                            $(".button_buy *").prop('disabled', true);
                        });
                        </script>
                        @endif
                </div>
                <script>
                $soLuongSPMua = 1;
                $(document).ready(function() {
                    $('#btnGiamSL').prop('disabled', true);
                    $('#btnGiamSL').click(function() {
                        $soLuongSPMua = $soLuongSPMua - 1;
                        $('#btnHienSL').text($soLuongSPMua);
                        $('input[name="soLuongSPChiTiet"]').val($soLuongSPMua);
                        if ($('#btnHienSL').text() <= '1') {
                            $('#btnGiamSL').prop('disabled', true);
                        }
                    });
                    $('#btnTangSL').click(function() {
                        $soLuongSPMua = $soLuongSPMua + 1;
                        $('#btnHienSL').text($soLuongSPMua);
                        $('input[name="soLuongSPChiTiet"]').val($soLuongSPMua);
                        if ($('#btnHienSL').text() > '1') {
                            $('#btnGiamSL').prop('disabled', false);
                        }
                    });
                    $('#btnThemGioHang').click(function() {
                        $('input[name="inputMuaNgay"]').val('ThemSPGioHang');
                        $('#formThemSPGioHang').trigger('submit');
                    });
                });
                </script>
                <div class="button_buy">
                    <button class="btn btn--add" id="btnThemGioHang">Thêm vào Giỏ Hàng</button>
                    <button class="btn btn-buy--now" onclick="$('#formThemSPGioHang').trigger('submit')">Mua
                        Ngay</button>
                </div>


            </div>
        </div>

        <div class="col-lg-3 col-12 boder-end bg type">
            <div class="service">
                <h1 class="fs-5">Dịch vụ</h1>
                <p class="select_location">Tùy chọn giao hàng</p>
                <div class="row mt-3 gx-1">
                    <div class="location">
                        <div class="location_img">
                            <img src="{{asset('uploads/dv9.png')}}" alt="">
                            <p class="text-size ">Chọn khu vực của bạn</p>
                        </div>
                        <div class="change_location">
                            <a class="text-size link-color text-decoration-none" href="">Thay đổi</a>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 gx-1 ">
                    <div class="col-1">
                        <img src="{{asset('uploads/dv10.png')}}" alt="">
                    </div>
                    <div class="col">
                        <a href="" class="text-size text-decoration-none link-color">Hệ thống 48 cửa hàng toàn
                            quốc</a>
                        <small class="d-block">(Mở cửa từ 9h00 - 24h00)</small>
                    </div>
                </div>
                <div class="row mt-6 gx-1 ">
                    <div class="col-1">
                        <img src="{{asset('uploads/dv2.png')}}" alt="">
                    </div>
                    <div class="col">
                        <p class="text-size">GH tiêu chuẩn</p>
                        <small class="d-block text-small">Nhận hàng từ 1 - 2 ngày</small>
                    </div>
                </div>
                <div class="row mt-6 gx-1 ">
                    <div class="col-1">
                        <img src="{{asset('uploads/dv1.png')}}" alt="">
                    </div>
                    <div class="col">
                        <p class="text-size">GH hỏa tốc</p>
                        <small class="d-block text-small">Nhận ngay trong ngày</small>
                    </div>
                </div>
                <div class="row mt-6 gx-1 ">
                    <div class="col-1">
                        <img src="{{asset('uploads/dv3.png')}}" alt="">
                    </div>
                    <div class="col">
                        <p class="text-size">Thanh toán khi nhận hàng (Được đồng kiểm trước khi nhận hàng)</p>

                    </div>
                </div>

            </div>
            <hr>
            <div class="insurance">
                <p class="text-size select_location">Đổi trả & bảo hàng</p>
                <div class="row mt-6 gx-1 mg ">
                    <div class="col-1">
                        <img src="{{asset('uploads/dv4.png')}}" alt="">
                    </div>
                    <div class="col">
                        <p class="text-size"> 7 ngày trả hàng cho nhà bán hàng </p>

                        <small class="d-block "> Không được trả hàng với lí do "không vừa ý"</small>

                    </div>
                </div>
                <div class="row mt-6 gx-1 ">
                    <div class="col-1">
                        <img src="{{asset('uploads/dv5.png')}}" alt="">
                    </div>
                    <div class="col">
                        <p class="text-size">Áp dụng bảo hành 1 đổi 1</p>
                        <small class="d-block text-small"> Hàng chưa sử dụng, lỗi do nhà sản xuất</small>

                    </div>
                </div>
            </div>
            <hr>
            <div class="delivery">
                <p class="text-size select_location">Giao hàng kính đáo</p>
                <div class="row mt-6 gx-1 ">
                    <div class="col-1">
                        <img src="{{asset('uploads/dv6.png')}}" alt="">
                    </div>
                    <div class="col">
                        <p class="text-size">Bọc trong thùng carton</p>

                    </div>
                </div>
                <div class="row mt-6 gx-1 ">
                    <div class="col-1">
                        <img src="{{asset('uploads/dv7.png')}}" alt="">
                    </div>
                    <div class="col">
                        <p class="text-size">Không để tên sản phẩm bên ngoài</p>

                    </div>
                </div>
                <div class="row mt-6 gx-1 ">
                    <div class="col-1">
                        <img src="{{asset('uploads/dv8.png')}}" alt="">
                    </div>
                    <div class="col">
                        <p class="text-size">Nhân viên giao hàng bên thứ 3</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </form> -->

    <div class="row gx-0 gy-2 gy-lg-4 gx-lg-3 mt-0">
        <div class="col-12 col-lg-9">

            @if(!$sanPham->combosp->isEmpty())
            <div class="product-recommend pt-3 pt-lg-0 mb-2 mb-lg-4 bg-white__mobile">
                <div class="bg-white card-body">
                    <strong class="fs-2" style="margin-bottom:30px;display:block">
                        Mua theo bộ sản phẩm
                    </strong>
                    <form accept-charset='UTF-8' id="formThem1BoSPGioHang" class="form-inline" method='post'
                        action="{{route('khachHang.thongTinSP.them1BoSPGioHang')}}">
                        @csrf
                        <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                            value="{{auth()->guard('kh')->user()? auth()->guard('kh')->user()->kh_ma: 0}}">
                        <input type="hidden" name="iDSPChiTiet" class="form-control" value="{{ $sanPham->sp_ma }}">

                        <div class="row row-cols-2 row-cols-md-4 row-cols-xl-5 gy-4 gx-2 buy-combo--list">

                            @php
                            $tongGiaBanSPTheoBo = 0;
                            $tongGiaGocSPTheoBo = 0;
                            @endphp

                            @foreach($sanPham->combosp as $comBoSP)
                            @if($comBoSP->sanphamphu->sp_soluong > 0)
                            @php

                            $giaban = App\Models\giaban::where('sp_ma', $comBoSP->sanphamphu->sp_ma)->where('dv_ma',
                            $comBoSP->dv_ma)->where('tinhtrang','1')->first();

                            $giaBanCuaSp = $giaban->giaban - ($giaban->giaban*$giaban->giamgia/100);
                            $tongGiaBanSPTheoBo += $giaBanCuaSp;
                            $tongGiaGocSPTheoBo += $giaban->giaban;

                            $sPCoKhuyenMai=
                            App\Models\khuyenmai::where('sp_ma',$comBoSP->sanphamphu->sp_ma)->where('km_tinhtrang',1)->first();
                            @endphp

                            <div class="col recommend-item buy-combo">
                                <div class="row gx-2 align-items-center h-100">
                                    <div class="col position-relative h-100">
                                        <i
                                            class="product-recommend__remove fa fa-close position-absolute top-0 end-0 bg-white shadow p-1 rounded-pill text-center icon-remove">
                                        </i>

                                        <input type="hidden" name="iDSPComBo[]" class="form-control"
                                            value="{{ $comBoSP->sanphamphu->sp_ma }}">
                                        <input type="hidden" name="dVSPComBo[{{ $comBoSP->sanphamphu->sp_ma }}]"
                                            class="form-control" value="{{ $comBoSP->dv_ma }}">

                                        <a href="/khachHang/thongTinSP/chiTietSP/{{$comBoSP->sanphamphu->sp_ma}}"
                                            class="text-decoration-none text-reset ">
                                            <div class="shadow-item product-item card rounded-0 h-100">
                                                @if($sPCoKhuyenMai)
                                                <div class="product-gift-icon position-absolute">
                                                    <img src="{{asset('uploads/gift.svg')}}" alt="Ảnh Mẫu">
                                                </div>
                                                @endif
                                                <picture class="d-block ratio ratio-1x1">
                                                    <img class="lazy entered loaded product_img"
                                                        src="{{asset('uploads/'.$comBoSP->sanphamphu->sp_hinh)}}"
                                                        alt="Ảnh Mẫu">
                                                </picture>
                                                <div class=" d-block px-2 mt-2 text-decoration-none">
                                                    <h3 class="text-start text_extend text-dark">
                                                        {{$comBoSP->sanphamphu->sp_ten.'-'.$comBoSP->donvi->dv_ten.'-'.$comBoSP->sanphamphu->sp_ma}}
                                                    </h3>
                                                </div>
                                                <div class="mb-2 px-2 row g-0 align-items-center">
                                                    <span
                                                        class="text-size col-auto me-2 buy-price">{{number_format($giaBanCuaSp,0,".",".")}}đ</span>
                                                    <small class="col-auto px-2 py-1 d-inline-block  rounded">
                                                        -{{$giaban->giamgia}}% </small>
                                                    <del style="color: #828282"
                                                        class="small col-12 d-block buy-price--old">
                                                        {{ number_format($giaban->giaban,0,".",".") }}đ
                                                    </del>
                                                </div>
                                                <div class="d-flex px-2 align-items-center mb-2 product-item__review">
                                                    <div
                                                        class="starbaprv-widget starbaprv-preview-badge starbaprv-preview-badge--with-link">
                                                        @php
                                                        $laySP = App\Models\danhgia::where('sp_ma', $comBoSP->sanphamphu->sp_ma)->sum('sosao');
                                                        $laySoKH = App\Models\danhgia::where('sp_ma', $comBoSP->sanphamphu->sp_ma)->count('kh_ma');
                                                        if($laySoKH==0){
                                                            $soSaoDanhGia = 0;
                                                        }else {
                                                            $soSaoDanhGia = ceil((float)$laySP/(float)$laySoKH);
                                                        }
                                                        $soSaoChuaDanhGia = 5 - $soSaoDanhGia;
                                                        @endphp

                                                        <div class="icon-start starbap-prev-badge">
                                                            @for($i=0; $i<$soSaoDanhGia; $i++)
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            @endfor

                                                            @for($i=0; $i<$soSaoChuaDanhGia; $i++)
                                                            <i class="fa fa-star" aria-hidden="true" style="color:black;"></i>
                                                            @endfor
                                                            <!-- <a href="" class="starbap-star starbap--on"></a> -->
                                                            <span class=" starbap-prev-badgetext"
                                                                style="font-size:10px">
                                                                | Đã bán
                                                                {{App\Models\cthoadon::where('sp_ma', $comBoSP->sanphamphu->sp_ma)->get()->sum('soluong')}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>

                        <input type="hidden" name="tongGiaBanSPTheoBo" class="form-control"
                            value="{{ $tongGiaBanSPTheoBo }}">
                        <input type="hidden" name="tongGiaGocSPTheoBo" class="form-control"
                            value="{{ $tongGiaGocSPTheoBo }}">

                        <div
                            class="row row-cols-2 row-cols-md-4 row-cols-xl-12 gy-4 gx-2 gx-2 align-items-center h-100">
                            <div class="col recommend-item position-relative h-100 w-100">
                                <div class="d-flex justify-content-center align-items-center gap-2 mt-2 flex-column">
                                    <div><strong>Giá bán:</strong> <span
                                            class="text-danger fs-3 giaBan">{{number_format($tongGiaBanSPTheoBo,0,".",".")}}<sup>đ</sup></span>
                                    </div>
                                    <div class="text-decoration-line-through"><strong>Tổng:</strong> <span
                                            class="tongGiaBan">{{number_format($tongGiaGocSPTheoBo,0,".",".")}}<sup>đ</sup>
                                        </span></div>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Thêm Vào Giỏ Hàng</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <div class="hrvptabs pt-3 pt-lg-0 mb-2 mb-lg-4 bg-white__mobile">
                @if($sanPham->sp_mota!=null)
                <div class="bg-white card-body">
                    <strong class="fs-2 describe" style="margin-bottom:30px;display:block">
                        Mô tả sản phẩm
                    </strong>
                    {!!$sanPham->sp_mota!!}
                </div>
                @endif
            </div>
            <div class="product-description pt-3 pt-lg-0 mb-2 mb-lg-4 bg-white__mobile">
                @if($sanPham->sp_thongtin!=null)
                <div class="bg-white card-body">
                    <strong class="fs-3 detail_infor">Thông tin chi tiết</strong>
                    {!!$sanPham->sp_thongtin!!}
                </div>
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-3">
            <div class="pt-3 pt-lg-0 bg-white__mobile">

                <div class="bg-white p-3">
                    <strong class="related_products">
                        Sản phẩm liên quan
                    </strong>
                    <br>
                    <br>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-1 g-2">

                        @foreach($spLienQuans as $spLienQuan)
                        <a href="/khachHang/thongTinSP/chiTietSP/{{$spLienQuan->sp_ma}}"
                            class="text-decoration-none text-reset col">
                            <div class="shadow-item product-item card rounded-0 h-100">
                                @php
                                $sPCoKhuyenMai=
                                App\Models\khuyenmai::where('sp_ma',$spLienQuan->sp_ma)->where('km_tinhtrang',1)->first();
                                @endphp
                                @if($sPCoKhuyenMai)
                                <div class="product-gift-icon position-absolute h-100">
                                    <img src="{{asset('uploads/gift.svg')}}" alt="">
                                </div>
                                @endif
                                <div class="d-block ratio ratio-1x1">
                                    <img src="{{asset('uploads/'.$spLienQuan->sp_hinh)}}" alt="Ảnh Mẫu">
                                </div>
                                <div class="d-block pt-2 mt-2 text-decoration-none">
                                    @php
                                    if(strcmp($spLienQuan->donvis[0]->dv_ma, '1')!==0)
                                    $tenSPLienQuan = $spLienQuan->sp_ten.' - '.$spLienQuan->donvis[0]->dv_ten.' -
                                    '.$sanPham->sp_ma;
                                    else
                                    $tenSPLienQuan = $spLienQuan->sp_ten.' - '.$spLienQuan->sp_ma;
                                    @endphp
                                    <h3 class="text-start text_extend text-dark">
                                        {{$tenSPLienQuan}}
                                    </h3>
                                </div>
                                <div class="mb-2 px-2 row g-0 align-items-center">
                                    <span
                                        class="text-size col-auto me-2 ">{{ number_format($spLienQuan->donvis[0]->pivot->giaban - ($spLienQuan->donvis[0]->pivot->giaban*$spLienQuan->donvis[0]->pivot->giamgia/100)) }}đ</span>
                                    <small class="col-auto px-2 py-1 d-inline-block  rounded">
                                        -{{$spLienQuan->donvis[0]->pivot->giamgia}}% </small>
                                    <del style="color: #828282" class="small col-12 d-block ">
                                        {{number_format($spLienQuan->donvis[0]->pivot->giaban)}}đ </del>
                                </div>
                                <div class="d-flex px-2 align-items-center mb-2 product-item__review">
                                    <div
                                        class="starbaprv-widget starbaprv-preview-badge starbaprv-preview-badge--with-link">
                                        @php
                                        $laySP = App\Models\danhgia::where('sp_ma', $spLienQuan->sp_ma)->sum('sosao');
                                        $laySoKH = App\Models\danhgia::where('sp_ma', $spLienQuan->sp_ma)->count('kh_ma');
                                        if($laySoKH==0){
                                            $soSaoDanhGia = 0;
                                        }else {
                                            $soSaoDanhGia = ceil((float)$laySP/(float)$laySoKH);
                                        }
                                        $soSaoChuaDanhGia = 5 - $soSaoDanhGia;
                                        @endphp
                                        <div class="text-size starbap-prev-badge" style="font-size:10px">
                                        @for($i=0; $i<$soSaoDanhGia; $i++)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                            @for($i=0; $i<$soSaoChuaDanhGia; $i++)
                                            <i class="fa fa-star" aria-hidden="true" style="color:black;"></i>
                                            @endfor
                                            <span class=" starbap-prev-badgetext" style="font-size:10px">
                                                | Đã bán
                                                {{App\Models\cthoadon::where('sp_ma',$spLienQuan->sp_ma)->get()->sum('soluong')}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
    
</div>

@endsection

@section('lienKet-JS-CuoiTrang')
<script src="{{ asset('') }}"></script>

@endsection