@extends('boCuc')

@section('lienKet-CSS-DauTrang')
<link rel="stylesheet" href="{{ asset('css/taiKhoan.css') }}" />
@endsection

@section('lienKet-JS-DauTrang')
<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>
@endsection

@section('noiDung')
<section class="card-login py-4">
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-6 offset-3">

<div class="card h-100">
    <div class="card-body d-flex">
        <div class="col col-lg-9 mx-auto">
        <div class="card-title h2 text-danger mb-5">
        Đặt Lại Mật Khẩu
            </div>
            @if (Session::has('loiDatLaiMatKhau'))
            <div class="alert alert-danger mb-4" role="alert">
                {{ Session::get('loiDatLaiMatKhau') }}
            </div>
            @endif

            <form id="formDoiMatKhauEmail" action="{{ route('datLaiMatKhau.post') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group row">
                    <div class="col">
                        <input type="text" id="email" class="form-control" name="email" placeholder="Nhập địa chỉ email"
                            autofocus>
                        @if ($errors->has('email') && $errors->has('formDoiMatKhauEmail'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col">
                        <input type="password" id="password" name="password" class="form-control" 
                            placeholder="Nhập mật khẩu">
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col">
                        <input type="password" id="xacNhanMK" name="xacNhanMK" class="form-control"
                            placeholder="Nhập mật khẩu xác nhận">
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col">
                        <button type="submit" class="btn btn-success w-50">Đặt Lại Mật Khẩu</button>
                        <a href="{{ route('dangNhap.get') }}" type="button" class="btn btn-danger w-25">Trở Về</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
        </div>
    </div>
</section>
@endsection

@section('lienKet-JS-CuoiTrang')
<script src="{{ asset('js/auth/formDoiMatKhauEmail.js') }}"></script>
@endsection