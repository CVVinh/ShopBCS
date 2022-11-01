@extends('boCuc')

@section('lienKet-CSS-DauTrang')
<link rel="stylesheet" href="{{ asset('css/main.css') }}" />
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

                    <div class="info__general w-full">
                        <div class="container mb-4">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="card h-100">
                                        <div
                                            class="card-header bg-white d-flex flex-wrap justify-content-center align-items-center flex-column">

                                            <div class="order__info">
                                                
                                                <div class="order__info-content">
                                                    <a class="order__info-item toolbar_DanhSachDonHang" href="#"
                                                        onclick="$('#formIDKHTatCaDonHang').trigger('submit');">Tất
                                                        cả</a>
                                                    <a class="order__info-item toolbar_ChoXacNhan" href="#"
                                                        onclick="$('#formIDKHChoXacNhan').trigger('submit');">Chờ xác nhận</a>
                                                    <a class="order__info-item toolbar_DaHuy" href="#"
                                                        onclick="$('#formIDKHDonHangDaHuy').trigger('submit');">Đã
                                                        hủy</a>
                                                </div>
                                                
                                                @yield('noiDungSanPham')

                                            </div>

                                            <form id="formIDKHChoXacNhan" accept-charset='UTF-8'
                                                class="position-relative form-search" method='post'
                                                action="{{route('khachHang.hoSo.choXacNhan')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                                                        value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                                                </div>
                                            </form>

                                            <form id="formIDKHDonHangDaHuy" accept-charset='UTF-8'
                                                class="position-relative form-search" method='post'
                                                action="{{route('khachHang.hoSo.donHangDaHuy')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                                                        value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                                                </div>
                                            </form>

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

@endsection