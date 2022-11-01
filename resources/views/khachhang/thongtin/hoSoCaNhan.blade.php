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

                <div class="info__general">

                    <div class="container mb-4">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="card h-100">
                                    <div class="card-header bg-white">
                                        <h2 class="text-danger">Hồ Sơ Của Tôi</h2>
                                        <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                                    </div>
                                    <div class="card-body">

                                        @if (Session::has('thanhCong'))
                                        <div class="add-to-cart" role="alert">
                                            {{ Session::get('thanhCong') }}
                                        </div>
                                        @endif

                                        <form accept-charset='UTF-8' class='formCapNhat'
                                            action="{{route('khachHang.hoSo.capNhatHoSo')}}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                                                    value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
                                            </div>

                                            <div class="form-group row">
                                                <label for="ten" class="col-md-2 text-md-right col-form-label">Tên Người
                                                    Dùng:</label>

                                                <div class="col-md-6">
                                                    <input type="text" id="ten" class="form-control" name="ten"
                                                        value="{{auth()->guard('kh')->user()->ten}}"
                                                        placeholder="Tên người dùng" autofocus>
                                                    @if ($errors->has('ten'))
                                                    <span class="text-danger">{{ $errors->first('ten') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gioitinh" class="col-md-2 col-form-label text-md-right">Giới
                                                    Tính:</label>
                                                <div class="col-md-6">
                                                    <select class="mt-3 form-select" id="gioitinh" name="gioitinh">
                                                        <option value="Nam">Nam</option>
                                                        <option value="Nữ">Nữ</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="ngaysinh" class="col-md-2 col-form-label text-md-right">Ngày
                                                    Sinh:</label>
                                                <div class="col-md-6">
                                                    <input type="date" placeholder="mm/dd/yyyy" id="ngaysinh"
                                                        name="ngaysinh"
                                                        value="{{auth()->guard('kh')->user()->ngaysinh}}"
                                                        class="mt-3 form-control" />
                                                </div>

                                                <div class="col-md-2 offset-1">
                                                    @if(auth()->guard('kh')->user() &&
                                                    auth()->guard('kh')->user()->hinh!=null)
                                                    <div id="anh1">
                                                        <img src="{{asset('avatar/'.auth()->guard('kh')->user()->hinh)}}"
                                                            alt="avatar" class="image-avatar" />
                                                    </div>
                                                    @else
                                                    <div id="anh1">
                                                        <img src="{{asset('avatar/avatar.png')}}" alt="avatar"
                                                            class="image-avatar" />
                                                    </div>
                                                    @endif
                                                    <!-- https://images.unsplash.com/photo-1644982647711-9129d2ed7ceb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHwxfHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=600&q=60 -->
                                                    <input type="file" id="anhNguoiDung" name="hinh"
                                                        accept="image/png, image/jpeg, image/jpg" style="display:none">
                                                    <label for="anhNguoiDung" class="image-choose">
                                                        Chọn ảnh
                                                        {{-- <button class="w-75 mt-3 btn btn-success" type='button'>Chọn Ảnh</button> --}}
                                                    </label>
                                                    <script>
                                                    $(document).ready(function() {
                                                        function previewImages(input) {
                                                            var $preview = $('#anh1').empty();

                                                            if (this.files) $.each(this.files, readAndPreview);

                                                            function readAndPreview(i, file) {

                                                                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                                                                    return alert(file.name +
                                                                    " is not an image");
                                                                } 
                                                                var reader = new FileReader();

                                                                $(reader).on("load", function() {
                                                                    $preview.append($("<img/>", {
                                                                        src: this.result,
                                                                        height: 100
                                                                    }));
                                                                });

                                                                reader.readAsDataURL(file);
                                                            }
                                                        }
                                                        $('#anhNguoiDung').on("change", previewImages);
                                                    });
                                                    </script>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="sdt" class="col-md-2 col-form-label text-md-right">Số Điện
                                                    Thoại:</label>
                                                <div class="col-md-6">
                                                    <input type="sdt" placeholder="Số điện thoại" id="sdt" name="sdt"
                                                        value="{{auth()->guard('kh')->user()->sdt}}"
                                                        class="mt-3 form-control" />
                                                    @if ($errors->has('sdt') )
                                                    <span class="text-danger">{{ $errors->first('sdt') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email"
                                                    class="col-md-2 col-form-label text-md-right">Email:</label>
                                                <div class="col-md-6">
                                                    <input type="email" placeholder="Email" id="email" name="email"
                                                        value="{{auth()->guard('kh')->user()->email}}"
                                                        class="mt-3 form-control" />
                                                    @if ($errors->has('email') )
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6 offset-md-4">
                                                    <button class="w-25 mt-3 btn btn-success" type='submit'>Cập
                                                        Nhật</button>
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
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('.menu_suaHoSoKH').addClass('active');
    });
    </script>
</section>
@endsection

@section('lienKet-JS-CuoiTrang')
<script src="{{ asset('js/auth/formCapNhatHoSo.js') }}"></script>

@endsection