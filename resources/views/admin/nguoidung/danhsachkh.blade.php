@extends('admin.master')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Danh sách khách hàng</h3>
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger " role="alert">{{$error}}</div>
                            @endforeach
                            @endif
                            @if (session('thanhcong'))
                                <div class="alert alert-success thongbao" role="alert">{{session('thanhcong')}}</div>
                            @endif
                            @if (session('thatbai'))
                                <div class="alert alert-danger thongbao" role="alert">{{session('thatbai')}}</div>
                            @endif
                            @if (session('canhbao'))
                                <div class="alert alert-warning thongbao" role="alert">{{session('canhbao')}}</div>
                            @endif
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="pid">
                                                <label class="custom-control-label" for="pid"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm"><span>Tên khách hàng</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Ngày sinh</span></div>
                                        <div class="nk-tb-col"><span>Giới tính</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools">SDT</div>
                                    </div><!-- .nk-tb-item -->
                                    @foreach($khachhangs as $khachhang)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="{{$khachhang->kh_ma}}">
                                                <label class="custom-control-label" for="{{$khachhang->kh_ma}}"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <img src="{{ asset('/uploads/img/'.$khachhang->hinh) }}"
                                                    alt="" class="thumb">
                                                    <div class="user-info">
                                                        <span class="tb-lead">{{$khachhang->ten}} <span class="dot dot-success d-md-none ml-1"></span></span>
                                                        <span>{{$khachhang->email}}</span>
                                                    </div>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <span class="title">{{$khachhang->ngaysinh}}</span>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <span class="title">{{$khachhang->gioitinh}}</span>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <span class="title">{{$khachhang->sdt}}</span>
                                            </span>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    @endforeach
                                </div><!-- .nk-tb-list -->
                            </div>
                            <div class="card-inner">
                                <div class="nk-block-between-md g-3">
                                    <div class="g">
                                        <ul class="pagination justify-content-center justify-content-md-start">
                                            <li
                                                class="page-item {{ $khachhangs->currentPage() == 1 ? ' disabled' : '' }}">
                                                <a class="page-link" href="{{ $khachhangs->previousPageUrl() }}"><em
                                                        class="icon ni ni-chevrons-left"></em></a>
                                            </li>
                                            @for ($i = 1; $i <= $khachhangs->lastPage(); $i++)
                                                <li
                                                    class="page-item {{ $khachhangs->currentPage() == $i ? ' active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $khachhangs->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li
                                                class="page-item {{ $khachhangs->currentPage() == $khachhangs->lastPage() ? ' disabled' : '' }}">
                                                <a class="page-link" href="{{ $khachhangs->nextPageUrl() }}"><em
                                                        class="icon ni ni-chevrons-right"></em></a>
                                            </li>
                                        </ul><!-- .pagination -->
                                    </div>
                                    <div class="g">
                                    Hiển thị từ {{$khachhangs->firstItem()}} đến {{$khachhangs->lastItem()}} của {{$khachhangs->total()}} khách hàng
                                    </div>
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
@endsection