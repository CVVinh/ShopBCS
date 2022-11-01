@extends('layout')

@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cập Nhật Thông Tin</div>
                    <div class="card-body">

                        @if (Session::has('status'))
                        <div class="alert alert-danger" role="alert" >
                            {{ Session::get('status') }}
                        </div>
                        @endif

                        @auth('admin')
                        <form class="formCapNhatThongTin" action="{{ route('admin.post.update') }}" method="POST">
                        @else
                        <form class="formCapNhatThongTin" action="{{ route('user.post.update') }}" method="POST">
                        @endauth
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Tên Đăng Nhập: <b
                                        class="yeuCau">(*)</b></label>
                                <div class="col-md-6">
                                    <input type="text" id="name" class="form-control" name="name" value="{{$user->name}}"
                                        placeholder="Nhập tên đăng nhập" autofocus>
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sdt" class="col-md-4 col-form-label text-md-right">Số Điện Thoại: <b
                                        class="yeuCau">(*)</b></label>
                                <div class="col-md-6">
                                    <input type="text" id="sdt" class="form-control" name="sdt" value="{{$user->sdt}}"
                                        placeholder="Nhập số điện thoại">
                                    @if ($errors->has('sdt'))
                                    <span class="text-danger">{{ $errors->first('sdt') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Địa Chỉ
                                    Email:</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" value="{{$user->email}}"
                                        placeholder="Nhập địa chỉ Email">
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Cập Nhật
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


@section('link-jsFooter')
<script>
// xac thuc form dang ky
$('.formCapNhatThongTin').validate({
    rules: {
        'name': {
            required: true,
            maxlength: 25,
        },
        'email': {
            email: true,
            maxlength: 40,
        },
        'sdt': {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 11,
        },
    },
    messages: {
        'name': {
            required: "Bạn chưa nhập tên đăng nhập",
            maxlength: "Tên đăng nhập quá dài",
        },
        'email': {
            email: "Email không hợp lệ",
            maxlength: "Địa chỉ Email quá dài",
        },
        'sdt': {
            required: "Bạn chưa nhập số điện thoại",
            number: "Số điện thoại phải là một dãy số",
            minlength: "Số điện thoại phải có ít nhất 10 chữ số",
            maxlength: "Số điện thoại không lớn hơn 11 chữ số",
        },
    },
    errorElement: "div",
    errorPlacement: function(error, element) {
        error.addClass("invalid-feedback");
        if (element.prop("type") === "checkbox") {
            error.insertAfter(element.siblings("label"));
        } else {
            error.insertAfter(element);
        }
    },
    highlight: function(element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
    }
});


</script>
@endsection