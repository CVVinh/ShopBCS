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
            <div class="col-md-6 form-center">
                <div class="card h-100">
                    <div class="card-body d-flex">
                        <div class="col col-lg-9 mx-auto">
                            <div class="card-title h2 text-danger mb-5">
                                <p style="text-align: center;"> Đăng ký thành viên mới</p>
                            </div>

                            @if (Session::has('dangKyThanhCong'))
                            <div class="alert alert-danger mb-4" role="alert">
                                {{ Session::get('dangKyThanhCong') }}
                            </div>
                            @endif

                            <form accept-charset='UTF-8' action="{{ route('dangKy.post') }}" class='formDangKy'
                                method='post'>
                                @csrf

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" placeholder="Tên người dùng" name="ten" 
                                        value="{{ old('tem') }}"
                                            class="shadow-none form-control" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <select class="mt-3 form-select" name="gioitinh">
                                            <option value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="date" placeholder="mm/dd/yyyy" name="ngaysinh" value="{{ old('ngaysinh') }}"
                                            class="mt-3 shadow-none form-control" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" placeholder="Số điện thoại" name="sdt" value="{{ old('sdt') }}"
                                            class="mt-3 shadow-none form-control" />
                                        @if ($errors->has('sdt') && $errors->has('formDangKy'))
                                        <span class="text-danger">{{ $errors->first('sdt') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" placeholder="Email" name="email" value="{{ old('email') }}"
                                            class="mt-3 shadow-none form-control" />
                                        @if ($errors->has('email') && $errors->has('formDangKy'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="password" placeholder="Mật khẩu" id="password" name="password"
                                            class="mt-3 shadow-none form-control" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="password" placeholder="Xác nhận mật khẩu" id="xacnhanmatkhau"
                                            name="xacnhanmatkhau" class="mt-3 shadow-none form-control" />
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <div class="col">
                                        <div class="g-recaptcha" data-sitekey="6Lc_LksgAAAAAC1g3ags9viSdssmaX6VlxmXFdn4"
                                            data-callback="captcharRegister"></div>

                                        @if ($errors->has('g-recaptcha-response') && $errors->has('formDangKy'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                        <span id="loiRobotDangKy" class="text-danger anThe">Tôi không phải là người
                                            máy.</span>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <div class="col">
                                        <button class="btn-login" type='submit'>Đăng ký</button>
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <hr />
                                    <div class="col-md-6">
                                        <a href="auth/facebook"type="button" class="col-md-6 btn btn-info w-100 ">Facebook</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="auth/google" type="button" class="col-md-6 btn btn-danger w-100">Google+</a>
                                    </div>
                                </div>

                                <div class="form-group row text-center mt-4">
                                    <div class="col">
                                    <p>Bằng việc đăng ký, bạn đã đồng ý với PlayBoy về <a href="#" class="text-danger text-decoration-none"><b class="text-blue">Điều khoản dịch vụ</b></a> & <a href="#" class="text-danger text-decoration-none"><b class="text-blue">Chính sách bảo mật</b></a> </p>
                                        <p>Bạn đã có tài khoản? <a href="{{ route('dangNhap.get') }}" class="text-danger text-decoration-none"><b>Đăng nhập</b></a></p>
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
<script src="{{ asset('js/auth/dangKy.js') }}"></script>
@endsection