@extends('admin.master')
@section('content')
    <div class="nk-content ">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Đổi mật khẩu</h5>
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endforeach
                @endif
                @if (session('thanhcong'))
                    <div class="alert alert-success" role="alert">{{ session('thanhcong') }}</div>
                @endif
                @if (session('thatbai'))
                    <div class="alert alert-danger" role="alert">{{ session('thatbai') }}</div>
                @endif
                @if (session('canhbao'))
                    <div class="alert alert-warning" role="alert">{{ session('canhbao') }}</div>
                @endif
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="row g-3">
                <div class="col-12">
                    <form action="{{route('admin.taikhoan.doimk',['id'=>$nhanvien->nv_ma])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Mật khẩu cũ</label>
                            <div class="col-sm-3">
                                <input type="password" class="form-control" id="basic-default-name" placeholder="Nhập mật khẩu cũ" name="passwordold"  required/>
                            </div>
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Mật khẩu mới</label>
                            <div class="col-sm-3">
                                <input type="password" class="form-control" id="basic-default-name" placeholder="Nhập mật khẩu mới" name="passwordnew" required/>
                            </div>
                            <div class="col-sm-2">
                                <button style="float: right" type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- .nk-block -->
    </div><!-- .nk-content -->
@endsection