@extends('admin.master')

@section('content')
<section class="card-login py-4">
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="card h-100 w-100 mt-5">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-center align-items-center"><span class="h5">ĐĂNG NHẬP THÀNH CÔNG</span></div>
                </div>
                <div class="card-body d-flex">
                    <div class="col col-lg-9 mx-auto">

                        @if (session('thongBaoChaoMung'))
                        <div class="alert alert-success" role="alert">
                            {{ session('thongBaoChaoMung') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection