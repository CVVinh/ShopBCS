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

            <script>
            $(document).ready(function() {
                $('.menu_themDiaChi').addClass('active');
            });
            </script>

            <div class="info__general w-full">
                <div class="container mb-4">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="card h-100">
                                <div class="card-header bg-white d-flex flex-wrap">
                                    <div class="info__ship w-100">

                                        @if(session('thanhCong'))
                                        <div class="add-to-cart thongbao" role="alert">
                                            {{ session('thanhCong') }}
                                        </div>
                                        @endif

                                        @if(session('thatBai'))
                                        <div class="add-to-cart" role="alert">
                                            {{ session('thatBai') }}
                                        </div>
                                        @endif

                                        <h3 class="address-title d-block">Địa chỉ của tôi</h3>

                                        <a href="#" class="btn btn-primary w-50 mb-2 address-hidden active"> &nbsp;
                                            <i class="fa fa-plus" aria-hidden="true"></i>Thêm địa chỉ mới
                                        </a>

                                        @if (isset($thatBai))
                                        <div class="alert alert-danger mb-4" role="alert">
                                            {{ $thatBai}}
                                        </div>
                                        @endif

                                        <form accept-charset='UTF-8' class="add-address formThemDiaChiKH" method='post'
                                            action="{{route('khachHang.hoSo.themDiaChiKh')}}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="kh_ma" class="form-control"
                                                    value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="name" name="dc_tenkh" placeholder="Tên">
                                                @if ($errors->has('dc_tenkh'))
                                                <span class="text-danger">{{ $errors->first('dc_tenkh') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="name" name="dc_sdt"
                                                    placeholder="Số điện thoại">
                                                @if ($errors->has('dc_sdt'))
                                                <span class="text-danger">{{ $errors->first('dc_sdt') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="address" name="dc_ten" placeholder="Địa chỉ">
                                                @if ($errors->has('dc_ten'))
                                                <span class="text-danger">{{ $errors->first('dc_ten') }}</span>
                                                @endif
                                            </div>
                                            <div class="d-flex justify-content-end">

                                                <button type="submit"
                                                    class="btn-secondary w-10 button__add">Thêm</button>
                                            </div>
                                        </form>

                                        @if(isset($diaChis))
                                        @foreach($diaChis as $diachi)
                                        <div class="d-flex align-items-end gap-2">
                                            <form accept-charset='UTF-8' method='post'
                                                action="{{route('khachHang.hoSo.suaDiaChiKh')}}">
                                                @csrf
                                                <div class="d-flex align-items-end gap-2 justify-content-between">
                                                    <div class="full-thongtin d-flex gap-2">
                                                        <div class="form-group">
                                                            <input type="hidden" name="iDSPKHChiTiet"
                                                                class="form-control"
                                                                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="maDiaChi" class="form-control"
                                                                value="{{$diachi->dc_ma}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="d-block">Tên:
                                                                <input type="text" class="input-kh d-block"
                                                                    value="{{$diachi->dc_tenkh}}" name="tenKH">
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="d-block">Số điện thoại:
                                                                <input type="text" class="input-kh d-block"
                                                                    value="{{$diachi->dc_sdt}}" name="sdtKh"
                                                                    id="input-sdt">
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="d-block" style="width:100%">Địa chỉ:
                                                                <input type="text" class="input-kh"
                                                                    value="{{$diachi->dc_ten}}" name="diaChiKh"
                                                                    style="width:100%">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <button type="submit"
                                                            class=" btn btn-success address-edit">Lưu</button>

                                                    </div>
                                                </div>

                                            </form>

                                            <form id="formIDKHXoaDC{{$diachi->dc_ma}}" accept-charset='UTF-8'
                                                method='post' action="{{route('khachHang.hoSo.xoaDiaChiKh')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                                                        value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                                                    <input type="hidden" name="maDiaChi" class="form-control"
                                                        value="{{$diachi->dc_ma}}" />
                                                </div>
                                                <button id="xoaDCKH{{$diachi->dc_ma}}"
                                                    class=" btn btn-danger address-edit">Xoá</button>
                                            </form>
                                            <script>
                                            $(document).ready(function() {
                                                $('#xoaDCKH{{$diachi->dc_ma}}').click(function(event) {
                                                    event.preventDefault();
                                                    if (confirm('Bạn có chắc muốn xóa địa chỉ này?')) {
                                                        $('#formIDKHXoaDC{{$diachi->dc_ma}}').trigger(
                                                            'submit');
                                                    }
                                                });

                                                function disableF5(e) {
                                                    if ((e.which || e.keyCode) == 116 || (e.which || e
                                                        .keyCode) == 82 || (e.which || e.keyCode) == 123 || (e
                                                            .which || e.keyCode) == 154) e.preventDefault();
                                                    e.stopPropagation();
                                                    $('#formIDKHThemDiaChi').trigger('submit');
                                                };
                                                $(document).on("keydown", disableF5);
                                            });
                                            </script>

                                        </div>
                                        @endforeach
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

@endsection

@section('lienKet-JS-CuoiTrang')
<script src="{{ asset('js/auth/themDiaChi.js')}}"></script>

@endsection