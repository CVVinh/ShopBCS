
<div class="card h-100" id="theDangNhapHT">
    <!-- <div class="card-header bg-white">
        <span class="h5"></span>
    </div> -->
    <div class="card-body d-flex">
        <div class="col col-lg-9 mx-auto">
            <div class="card-title h2 text-danger mb-5">
                <p style="text-align: center;"> Đăng nhập</p>
            </div>
            @if (session('loiDangNhap'))
            <div class="alert alert-danger mb-4" role="alert">
                {{ session('loiDangNhap') }}
            </div>
            @endif

            @if (session('dangNhapThanhCong'))
            <div class="alert alert-success mb-4" role="alert">
                {{ session('dangNhapThanhCong') }}
            </div>
            @endif

            <form id="formDangNhap" accept-charset='UTF-8' action="{{ route('dangNhap.post') }}" method='post'>
                @csrf
                <div class="form-group row">
                    <div class="col">
                        <input type="text" name="email" class="shadow-none form-control"
                            placeholder="Nhập email hoặc số điện thoại" autofocus />
                        @if ($errors->has('email') && $errors->has('formDangNhap'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col position-r">
                        <input type="password" name="password" placeholder="Mật khẩu"
                        class="shadow-none form-control" id="pw" />
                        <i class="fa fa-eye eye-close" aria-hidden="true"></i>
                        <i class="fa fa-eye-slash eye-open" aria-hidden="true"></i>
            
           
                    </div>
                </div>

                <div class="form-check row mt-4">
                    <div class="col">
                        <div class="checkbox">
                            <label class="form-check-label">
                                <input class="form-check-input shadow-none" type="checkbox" name="nhotoi"> Nhớ tên tài
                                khoản
                            </label>
                        </div>
                        
                    </div>
                </div>

                <div class="form-group row text-center">
                    <div class="col">
                        <button class="btn-login" type='submit'>Đăng nhập</button>
                        <p class="mt-2"><a class="text-decoration-none" onclick="QuenMatKhau()" href="#">Quên mật khẩu?</a></p>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <hr />
                    <div class="col-md-6">
                        <a href="auth/facebook" type="button" class="col-md-6 btn btn-info w-100">Facebook</a>
                    </div>
                    <div class="col-md-6">
                        <a href="auth/google" type="button" class="col-md-6 btn btn-danger w-100">Google+</a>
                    </div>
                </div>

                <div class="form-group row text-center mt-4">
                    <div class="col">
                        <p>Bạn mới biết đến PlayBoy? <a href="{{ route('dangKy.get') }}" class="text-danger text-decoration-none"><b class="text-blue">Đăng
                                    ký</b></a></p>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    const eopen = document.querySelector(".eye-open");
const eclose = document.querySelector(".eye-close");
const ip = document.getElementById("pw");

eopen.addEventListener("click", () => {
    eopen.classList.add("hidden");
    eclose.classList.remove("hidden");
    ip.type = "password";
})
eclose.addEventListener("click", () => {
    eclose.classList.add("hidden");
    eopen.classList.remove("hidden");
    ip.type = "text";
})
</script>