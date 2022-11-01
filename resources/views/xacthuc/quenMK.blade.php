<div class="card h-100 anThe" id="theChonPhuongThuc">
    <div class="card-body d-flex">
        <div class="col col-lg-9 mx-auto">
        <div class="card-title h2 text-danger mb-5">
        Chọn phương thức xác nhận
            </div>
            <div class="row mt-4">
                <div class="col">
                    <button type="button" class="btn btn-success w-100" onclick="XacNhanBangDienThoai();">Xác
                        Nhận Bằng Điện Thoại</button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <button type="button" class="btn btn-success w-100" onclick="XacNhanBangEmail();">Xác
                        Nhận Bằng Email</button>
                </div>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col">
                    <button type="button" class="btn btn-danger w-100" onclick="TroVeDN()">Trở
                        Về</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card h-100 anThe" id="theDoiMKEmail">
    <div class="card-header bg-white h5">Đặt Lại Mật Khẩu</div>
    <div class="card-body d-flex">
        <div class="col col-lg-9 mx-auto">
            @if (Session::has('thongBaoDoiMKEmail') || Session::has('loiDoiMKEmail') || $errors->has('formDoiMKEmail'))
            <script>
            $('#theDangNhapHT').hide();
            $('#theDoiMKEmail').show();
            </script>
            @endif

            @if (Session::has('thongBaoDoiMKEmail'))
            <div class="alert alert-success mt-4" role="alert" id="thongBaoDoiMKEmail">
                {{ Session::get('thongBaoDoiMKEmail') }}
            </div>
            @endif

            @if (Session::has('loiDoiMKEmail'))
            <div class="alert alert-danger mt-4" role="alert" id="loiDoiMKEmail">
                {{ Session::get('loiDoiMKEmail') }}
            </div>
            @endif

            <form class="formDoiMKEmail" accept-charset='UTF-8' action="{{ route('quenMatKhau.post') }}" method="POST">
                @csrf
                <div class="form-group row mt-2 h5">
                    <label for="email" class="col col-form-label text-md-right">Địa Chỉ Email:</label>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <input type="text" class="shadow-none form-control" name="email" id="email"
                            placeholder="Nhập địa chỉ email" autofocus>
                        @if ($errors->has('email') && $errors->has('formDoiMKEmail'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col">
                        <div class="g-recaptcha" data-sitekey="6Lc_LksgAAAAAC1g3ags9viSdssmaX6VlxmXFdn4" data-callback="onCompleted"></div>

                        @if ($errors->has('g-recaptcha-response') && $errors->has('formDoiMKEmail'))
                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                        @endif
                        <span id="loiRobotEmail" class="text-danger anThe">Tôi không phải là người máy.</span>
                    </div>
                </div>


                <div class="row mt-3 mb-5">
                    <div class="col">
                        <button type="submit" class="btn btn-info mt-3 w-50">Gửi Liên Kết</button>
                        <button type="button" class="btn btn-danger mt-3 w-25" onclick="TroVe();">Trở Về</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- card xac thuc bang phone -->
<div class="card anThe h-100" id="theDoiMKDienThoai">
    <div class="card-header bg-white h5">Đặt Lại Mật Khẩu</div>
    <div class="card-body d-flex">
        <div class="col col-lg-9 mx-auto">

            <div class="alert alert-danger mt-4 anThe" id="loiNhapSDT"></div>
            <div class="alert alert-success mt-4 anThe" id="thongBaoGuiMaSDT"></div>

            <form class="formDoiMKNhapSDT">
                @csrf
                <div class="form-group row mt-2 h5">
                    <label for="sdtDoiMK" class="col col-form-label text-md-right">Số Điện Thoại:</label>
                </div>
                <div class="row form-group">
                    <div class="col">
                        <input type="text" id="sdtDoiMK" name="sdtDoiMK" class="shadow-none form-control"
                            placeholder="Nhập số điện thoại" autofocus>
                    </div>
                </div>

                <div class="row form-group mt-3">
                    <div class="col">
                        <div id="recaptchaContainer"></div>
                        <div id="loiRobotDienThoai" class="text-danger anThe">Tôi không phải là người máy.
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-5">
                    <div class="col">
                        <button type="submit" class="btn btn-success w-25" onclick="guiSDTXacThuc();">Gửi</button>
                        <button type="button" class="btn btn-danger w-25" onclick="TroVe();">Trở Về</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card h-100 anThe" id="theDoiMKXacNhanSDT">
    <div class="card-header bg-white h5">Đặt Lại Mật Khẩu</div>
    <div class="card-body d-flex">
        <div class="col col-lg-9 mx-auto">

            <div class="alert alert-danger mt-4 anThe" id="loiXacNhanMaSDT"></div>
            <div class="alert alert-success mt-4 anThe" id="thonngBaoXacNhanMaSDT"></div>

            <form class="formXacThucMaSDT" onsubmit="return XacThucMaSDTDoiMK();">
                @csrf
                <div class="form-group row mt-3 h5">
                    <label for="maXacThucSDT" class="col col-form-label text-md-right">Mã Xác Thực:</label>
                </div>
                <div class="row form-group mt-4">
                    <div class="col">
                        <input type="text" id="maXacThucSDT" class="form-control" name="maXacThucSDT" pattern="\d{6}"
                            maxlength="6" title="Mã xác nhận yêu cầu 6 chữ số!" placeholder="Nhập mã xác nhận" required
                            autofocus>
                    </div>
                </div>
                <div class="row mt-4 mb-5">
                    <div class="col">
                        <button type="submit" class="btn btn-success w-25">Xác Nhận</button>
                        <button type="button" class="btn btn-success w-25" onclick="guiSDTXacThuc();">Gửi
                            Lại</button>
                        <button type="button" class="btn btn-danger w-25" onclick="TroVe();">Trở Về</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- form doi mat khau bang OTP -->
<div class="card h-100 anThe" id="theDoiMKDatMK">
    <div class="card-body d-flex">
        <div class="col col-lg-9 mx-auto">
        <div class="card-title h2 text-danger mb-5">
        Đặt Lại Mật Khẩu
            </div>
            @if ($errors->has('formDoiMatKhauSDT'))
            <script>
            $('#theDangNhapHT').hide();
            $('#theDoiMKDatMK').show();
            </script>
            @endif

            <form id="formDoiMatKhauSDT" accept-charset='UTF-8' action="{{ route('datLaiMatKhauBangDienThoai.post') }}"
                method="POST">
                @csrf

                <div class="form-group row">
                    <div class="col">
                        <input type="text" id="sdt" class="form-control" name="sdt" placeholder="Nhập số điện thoại"
                            autofocus>
                        @if ($errors->has('sdt') && $errors->has('formDoiMatKhauSDT'))
                        <span id="idDoiMKSDT" class="text-danger">{{ $errors->first('sdt') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới"
                            autofocus>
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col">
                        <input type="password" class="form-control" id="xacNhanMK" name="xacNhanMK"
                            placeholder="Nhập mật khẩu xác nhận" autofocus>
                    </div>
                </div>

                <div class="form-group row mt-4 mb-5">
                    <div class="col">
                        <button id="btnGuiDoiMK" type="submit" class="btn btn-success w-50">Đổi Mật Khẩu</button>
                        <button type="button" class="btn btn-danger w-25" onclick="TroVe();">Trở Về</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
