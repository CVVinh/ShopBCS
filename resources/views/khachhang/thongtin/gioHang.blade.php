@extends('boCuc')

@section('lienKet-CSS-DauTrang')
<link rel="stylesheet" href="{{ asset('css/khachHang.css') }}" />

@endsection

@section('lienKet-JS-DauTrang')
<script src=''></script>
@endsection

@section('noiDung')
<section>
    <div class="grid khungHienThi">
        <div class="wrapper">
            <div class="info">
                @include('khachhang.menuKh')

                <div class="info__general w-full">
                    <div class="container mb-4 position-relative">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="card h-100">
                                
                                    <div
                                        class="card-header bg-white d-flex flex-wrap justify-content-center align-items-center flex-column">
                                        <div class="mycart">
                                            <i class=" fa fa-chevron-left icon-back" onclick="window.history.back()" aria-hidden="true"></i>
                                            <h2>Giỏ hàng của bạn</h2>
                                            @php
                                            $slsp = 0;
                                                if(auth()->guard('kh')->user()){
                                                    $soLuongSP =
                                                    App\Models\hoadon::where('kh_ma',auth()->guard('kh')->user()->kh_ma)->where('hd_tinhtrang','0')->first();
                                                    if($soLuongSP!=null){
                                                    foreach($soLuongSP->sanphams as $sp){
                                                    $slsp += $sp->pivot->soluong;
                                                    }
                                                }
                                            }
                                            @endphp
                                            <div id="gioHangRong" class="empty-cart">
                                                <img src="{{asset('uploads/gioHangRong.png')}}" alt="">
                                            <span>Giỏ hàng của bạn đang trống</span>
                                            <a href="/">Tiếp tục mua hàng</a>
                                            </div>
                                            @if(empty($dsSPGioHangs) || !isset($dsSPGioHangs))
                                            <script>$('#gioHangRong').show();</script>
                                            @else
                                            <script>$('#gioHangRong').hide();</script>
                                        <div class="cart__info">
                                            <div class="cart__info-prices">
                                                @php
                                                $idChoSP = 1;
                                                $tongThanhToan = 0;
                                                @endphp
                                                @foreach($dsSPGioHangs as $sanPham)
                                                @if($sanPham[8] != null)
                                                <div id="xoaTheGoc{{$idChoSP}}" class="cart__info-price cart-item ">
                                                    <i id="nutXoaGoc{{$idChoSP}}" class="fa fa-times remove-sp" aria-hidden="true"></i>
                                                    <div class="cart__img">
                                                        <a href="/khachHang/thongTinSP/chiTietSP/{{$sanPham[0]}}" ><img src="{{asset('uploads/'.$sanPham[2])}}" alt="Ảnh Mẫu" /></a>
                                                    </div>
                                                    <div class="cart__price">
                                                        <p>{{$sanPham[1].' - '.$sanPham[4].' - '.$sanPham[0]}}</p>
                                                        <span id="giaBan{{$idChoSP}}" >{{number_format($sanPham[5],0,".",".")}}</span>đ
                                                        @php
                                                            $giaSPGoc = $sanPham[5]*$sanPham[3];
                                                            $tongThanhToan += $giaSPGoc;
                                                        @endphp
                                                        &nbsp;&nbsp;
                                                        <span id="giaGoc{{$idChoSP}}" class="cart__price--underline">{{number_format($sanPham[6],0,".",".")}}</span>đ
                                                        &nbsp;&nbsp;
                                                        <span id="phanTram{{$idChoSP}}" class="badge bg-danger">-{{$sanPham[7]}}%</span>
                                                        <div class="cart__mount">

                                                            <button id="btnGiamSL{{$idChoSP}}" class="decrease">-</button>
                                                            <button id="btnHienSL{{$idChoSP}}" type="button" class="quantity">{{$sanPham[3]}}</button>
                                                            <button id="btnTangSL{{$idChoSP}}" class="increase">+</button>

                                                            <div class="cart__total">
                                                                <p>Thành tiền: <span class="gia-tongsp" id="thanhTien{{$idChoSP}}">{{number_format($giaSPGoc,0,".",".")}}</span>đ
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                @if($sanPham[8]!='-1' && $sanPham[8]==$dsSPGioHangs[$sanPham[8]][0] &&
                                                $sanPham[9]==$dsSPGioHangs[$sanPham[8]][9])
                                                <div id="xoaTheKM{{$idChoSP}}" class="cart__info-price cart-item"> <!-- khuyenmai -->
                                                    <i id="nutXoaKM{{$idChoSP}}" class="fa fa-times remove-sp" aria-hidden="true"></i>
                                                    <div class="cart__img">
                                                    <a href="/khachHang/thongTinSP/chiTietSP/{{$dsSPGioHangs[$sanPham[8]][0]}}"><img src="{{asset('uploads/'.$dsSPGioHangs[$sanPham[8]][2])}}" alt="Ảnh Mẫu"/></a>
                                                    </div>
                                                    <div class="cart__price">
                                                        <p>{{$dsSPGioHangs[$sanPham[8]][1].' - '.$dsSPGioHangs[$sanPham[8]][4].' - '.$dsSPGioHangs[$sanPham[8]][0]}}
                                                        </p>
                                                        @php
                                                            $giaSPKM = $dsSPGioHangs[$sanPham[8]][5]*$sanPham[3];
                                                            $tongThanhToan += $giaSPKM;
                                                        @endphp
                                                        <span id="giaBanSPKM{{$idChoSP}}">{{number_format($dsSPGioHangs[$sanPham[8]][5],0,".",".")}}</span>đ
                                                        &nbsp;&nbsp;
                                                        <span class="cart__price--underline" id="giaGocSPKM{{$idChoSP}}">{{number_format($dsSPGioHangs[$sanPham[8]][6],0,".",".")}}</span>đ
                                                        <span class="badge bg-danger">-{{$dsSPGioHangs[$sanPham[8]][7]}}%</span>
                                                        <span class="text-danger">(Khuyến mãi <span id="textSLSPKM{{$idChoSP}}">{{$sanPham[3]}}</span>)</span>
                                                        <div class="cart__mount">
                                                            <div class="cart__total">
                                                                <p>Thành tiền: <span class="gia-tongsp" id="thanhTienSPKM{{$idChoSP}}">{{number_format($giaSPKM,0,".",".")}}</span>đ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <script>
                                                    var soLuongSPMua{{$idChoSP}} = {{$sanPham[3]}};
                                                    $(document).ready(function() {
                                                        @if($sanPham[3]==1)
                                                        $('#btnGiamSL{{$idChoSP}}').prop('disabled', true);
                                                        @endif

                                                        $('#btnGiamSL{{$idChoSP}}').click(function() {
                                                            var sLBanDau{{$idChoSP}} = parseInt($('#btnHienSL{{$idChoSP}}').text());
                                                            soLuongSPMua{{$idChoSP}} = soLuongSPMua{{$idChoSP}} - 1;
                                                            $('#btnHienSL{{$idChoSP}}').text(soLuongSPMua{{$idChoSP}});
                                                            
                                                            $.ajax({
                                                                url: "{{asset('khachHang/hoSo/thayDoiSLSPGioHang')}}",
                                                                type:"POST",
                                                                data:{
                                                                    iDSPMGoc:'{{$sanPham[10]}}',
                                                                    iDSPMKM:'{{$sanPham[8]!="-1" ? $dsSPGioHangs[$sanPham[8]][10]: -1}}',
                                                                    soLuongSPThayDoi:soLuongSPMua{{$idChoSP}},
                                                                    _token: '{{ csrf_token() }}'
                                                                }
                                                            });
                                                            
                                                            $('#btnTangSL{{$idChoSP}}').prop('disabled', true);
                                                            $('#btnGiamSL{{$idChoSP}}').prop('disabled', true);
                                                            setTimeout(function() {
                                                                $('#btnTangSL{{$idChoSP}}').prop('disabled', false);
                                                                if ($('#btnHienSL{{$idChoSP}}').text() > '1') {
                                                                    $('#btnGiamSL{{$idChoSP}}').prop('disabled', false);
                                                                }
                                                            }, 2000);

                                                            var tienSPBan = parseFloat($('#thanhTien{{$idChoSP}}').text().replace(/\./g, ''));
                                                            var tienSPKM = 0;
                                                            var kq2 = 0;
                                                            var sLSPGiam = 1;
                                                            if({{$sanPham[8]}}!='-1'){
                                                                tienSPKM = parseFloat($('#thanhTienSPKM{{$idChoSP}}').text().replace(/\./g, ''));
                                                                kq2 = (tienSPKM*soLuongSPMua{{$idChoSP}}/sLBanDau{{$idChoSP}})+'';
                                                                $('#thanhTienSPKM{{$idChoSP}}').text(kq2.replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                                                                $('#textSLSPKM{{$idChoSP}}').text(soLuongSPMua{{$idChoSP}});
                                                                sLSPGiam = 2;
                                                            }
                                                           
                                                            var layTongTien = parseFloat($('#tongThanhToan').text().replace(/\./g, ''));
                                                            layTongTien = layTongTien - tienSPBan - tienSPKM;
                                                            var kq1 = (tienSPBan*soLuongSPMua{{$idChoSP}}/sLBanDau{{$idChoSP}})+'';
                                                            var tinhTongTien = (layTongTien + parseFloat(kq1) + parseFloat(kq2))+'';
                                                            $('#thanhTien{{$idChoSP}}').text(kq1.replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                                                            $('#tongThanhToan').text(tinhTongTien.replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                                                            $('#sLSPThanhToan').text(parseInt($('#sLSPThanhToan').text())-sLSPGiam);
                                                            $('.soLuongSPGioHang').text(parseInt($('.soLuongSPGioHang').text())-sLSPGiam);
                                                            
                                                        });
                                                        
                                                        $('#btnTangSL{{$idChoSP}}').click(function() {
                                                            var sLBanDau{{$idChoSP}} = parseInt($('#btnHienSL{{$idChoSP}}').text());
                                                            soLuongSPMua{{$idChoSP}} = soLuongSPMua{{$idChoSP}} + 1;
                                                            $('#btnHienSL{{$idChoSP}}').text(soLuongSPMua{{$idChoSP}});
                                                            
                                                            $.ajax({
                                                                url: "{{asset('khachHang/hoSo/thayDoiSLSPGioHang')}}",
                                                                type:"POST",
                                                                data:{
                                                                    iDSPMGoc:'{{$sanPham[10]}}',
                                                                    iDSPMKM:'{{$sanPham[8]!="-1" ? $dsSPGioHangs[$sanPham[8]][10]: -1}}',
                                                                    soLuongSPThayDoi:soLuongSPMua{{$idChoSP}},
                                                                    _token: '{{ csrf_token() }}'
                                                                }
                                                            });
                                                            
                                                            $('#btnTangSL{{$idChoSP}}').prop('disabled', true);
                                                            $('#btnGiamSL{{$idChoSP}}').prop('disabled', true);
                                                            setTimeout(function() {
                                                                $('#btnTangSL{{$idChoSP}}').prop('disabled', false);
                                                                $('#btnGiamSL{{$idChoSP}}').prop('disabled', false);
                                                            }, 2000);

                                                            var tienSPBan = parseFloat($('#thanhTien{{$idChoSP}}').text().replace(/\./g, ''));
                                                            var tienSPKM = 0;
                                                            var kq2 = 0;
                                                            var sLSPTang = 1;
                                                            if({{$sanPham[8]}}!='-1'){
                                                                tienSPKM = parseFloat($('#thanhTienSPKM{{$idChoSP}}').text().replace(/\./g, ''));
                                                                kq2 = (tienSPKM*soLuongSPMua{{$idChoSP}}/sLBanDau{{$idChoSP}})+'';
                                                                $('#thanhTienSPKM{{$idChoSP}}').text(kq2.replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                                                                $('#textSLSPKM{{$idChoSP}}').text(soLuongSPMua{{$idChoSP}});
                                                                sLSPTang = 2;
                                                            }
                                                           
                                                            var layTongTien = parseFloat($('#tongThanhToan').text().replace(/\./g, ''));
                                                            layTongTien = layTongTien - tienSPBan - tienSPKM;
                                                            var kq1 = (tienSPBan*soLuongSPMua{{$idChoSP}}/sLBanDau{{$idChoSP}})+'';
                                                            var tinhTongTien = (layTongTien + parseFloat(kq1) + parseFloat(kq2))+'';
                                                            $('#thanhTien{{$idChoSP}}').text(kq1.replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                                                            $('#tongThanhToan').text(tinhTongTien.replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                                                            $('#sLSPThanhToan').text(parseInt($('#sLSPThanhToan').text())+sLSPTang);
                                                            $('.soLuongSPGioHang').text(parseInt($('.soLuongSPGioHang').text())+sLSPTang);
                                                            
                                                        });

                                                        $('#nutXoaGoc{{$idChoSP}}').click(function(){
                                                            var layTongTien = parseFloat($('#tongThanhToan').text().replace(/\./g, ''));
                                                            var tienSPBan = parseFloat($('#thanhTien{{$idChoSP}}').text().replace(/\./g, ''));
                                                            var tienSPKM = 0;
                                                            var slsp = 1;
                                                            if($('#thanhTienSPKM{{$idChoSP}}').length != 0){
                                                                tienSPKM = parseFloat($('#thanhTienSPKM{{$idChoSP}}').text().replace(/\./g, ''));
                                                                slsp = 2;
                                                                $('#xoaTheKM{{$idChoSP}}').remove();
                                                            }
                                                            
                                                            var tinhTongTien = (layTongTien - tienSPBan - tienSPKM)+'';
                                                            $('#sLSPThanhToan').text(parseInt($('#sLSPThanhToan').text()) - parseInt($('#btnHienSL{{$idChoSP}}').text())*slsp  );
                                                            $('.soLuongSPGioHang').text(parseInt($('.soLuongSPGioHang').text()) - parseInt($('#btnHienSL{{$idChoSP}}').text())*slsp  );
                                                            $('#tongThanhToan').text(tinhTongTien.replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                                                            
                                                            $.ajax({
                                                                url: "{{asset('khachHang/hoSo/xoaSPGocGioHang')}}",
                                                                type:"POST",
                                                                data:{
                                                                    iDSPMGoc:'{{$sanPham[10]}}',
                                                                    iDSPMKM:'{{$sanPham[8]!="-1" ? $dsSPGioHangs[$sanPham[8]][10]: -1}}',
                                                                    soLuongSPThayDoi:soLuongSPMua{{$idChoSP}},
                                                                    _token: '{{ csrf_token() }}'
                                                                }
                                                            });
                                                            $('#xoaTheGoc{{$idChoSP}}').remove();
                                                            if(parseInt($('#sLSPThanhToan').text())==0) $('#gioHangRong').show();
                                                        }); 

                                                        if({{$sanPham[8]}}!='-1') {
                                                        $('#nutXoaKM{{$idChoSP}}').click(function(){
                                                            var tienSPKM = parseFloat($('#thanhTienSPKM{{$idChoSP}}').text().replace(/\./g, ''));
                                                            var layTongTien = parseFloat($('#tongThanhToan').text().replace(/\./g, ''));
                                                            var tinhTongTien = (layTongTien - tienSPKM)+'';
                                                            $('#sLSPThanhToan').text(parseInt($('#sLSPThanhToan').text()) - parseInt($('#btnHienSL{{$idChoSP}}').text())  );
                                                            $('.soLuongSPGioHang').text(parseInt($('.soLuongSPGioHang').text()) - parseInt($('#btnHienSL{{$idChoSP}}').text())  );
                                                            $('#tongThanhToan').text(tinhTongTien.replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                                                            
                                                            $.ajax({
                                                                url: "{{asset('khachHang/hoSo/xoaSPKMGioHang')}}",
                                                                type:"POST",
                                                                data:{
                                                                    iDSPKHChiTiet: '{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}',
                                                                    iDSPMGoc:'{{$sanPham[10]}}',
                                                                    iDSPMKM:'{{$sanPham[8]!="-1" ? $dsSPGioHangs[$sanPham[8]][10]: -1}}',
                                                                    soLuongSPThayDoi: $('#btnHienSL{{$idChoSP}}').text(),
                                                                    _token: '{{ csrf_token() }}'
                                                                } /* ,
                                                                success:function(response){
                                                                    console.log(response);
                                                                    if(response) {
                                                                        $('.thanhCong').text(response.thanhCong);
                                                                    }
                                                                }, 
                                                                error: function(error) {
                                                                    console.log(error);
                                                                } */
                                                            });
                                                            $('#xoaTheKM{{$idChoSP}}').remove();
                                                            if(parseInt($('#sLSPThanhToan').text())==0) $('#gioHangRong').show();
                                                        });
                                                        }
                                                    });
                                                </script>

                                                @endif
                                                @php
                                                    $idChoSP++;
                                                @endphp
                                                @endforeach

                                                <div class="cart__info-price cart-item position-fixed bottom-0 start-0 end-0 w-100 d-flex justify-content-evenly get-shadow mt-0 " style="z-index:99">
                                                    <div class="cart__img">
                                                        <img src="{{asset('uploads/gioHang.png')}}" alt="Giỏ Hàng" />
                                                    </div>
                                                    <div class="cart__price text-center">
                                                        <p>Hiện có <b id="sLSPThanhToan" class="text-danger">{{$slsp}}</b> sản phẩm trong giỏ hàng</p>
                                                        <span>Tổng thanh toán: <b id="tongThanhToan" class="text-danger">{{number_format($tongThanhToan,0,".",".")}}</b> đ</span>
                                                        <div class="cart__mount">
                                                            <div class="cart__total d-flex gap-2">
                                                                <button id="xoaHetGioHang" class="btn btn-danger  w-50 ">Xoá hết</button>
                                                                <button class="btn btn-success w-50 bg-primary" onclick="$('#formIDKHThanhToan').trigger('submit');">Thanh Toán</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        @endif
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

    <form id="formIDKHXoaSPGioHang" accept-charset='UTF-8'
        method='post' action="{{route('khachHang.hoSo.xoaHetSPGioHang')}}">
        @csrf
        <div class="form-group">
            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
        </div>
    </form>
    <form id="formIDKHThanhToan" accept-charset='UTF-8'
        method='post' action="{{route('khachHang.hoSo.donHang')}}">
        @csrf
        <div class="form-group">
            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
        </div>
    </form>
    <script>
    $(document).ready(function() {
        $('#xoaHetGioHang').click(function(){
            if(confirm('Bạn thực sự muốn xoá hết sản phẩm trong giỏ hàng')){
                $('#formIDKHXoaSPGioHang').trigger('submit');
            }
        }); 
      
    });

    function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82 || (e.which || e.keyCode) == 123 || (e.which || e.keyCode) == 154) e.preventDefault(); e.stopPropagation(); $('#formIDKHGioHang').trigger('submit');};
    $(document).on("keydown", disableF5);

    </script>

</section>
@endsection

@section('lienKet-JS-CuoiTrang')


@endsection
