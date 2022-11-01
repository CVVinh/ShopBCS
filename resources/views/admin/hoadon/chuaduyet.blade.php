@extends('admin.master')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Danh sách hóa đơn chưa duyệt</h3>
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
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-toggle="dropdown">Trạng thái</a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><span>Đang sử dụng</span></a></li>
                                                        <li><a href="#"><span>Ngừng sử dụng</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="{{route('admin.hoadon.them')}}" data-target="addProduct" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="{{route('admin.hoadon.them')}}" data-target="addProduct" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Thêm</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
                                        <div class="nk-tb-col tb-col-sm"><span>ID</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Ngày tạo</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Ngày cập nhật gần nhất</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Tổng tiền</span></div>
                                        <div class="nk-tb-col"><span>Trạng thái</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="mr-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em class="icon ni ni-trash"></em><span>Xóa tất cả</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    @foreach($hoadons as $hoadon)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="{{$hoadon->hd_ma}}">
                                                <label class="custom-control-label" for="{{$hoadon->hd_ma}}"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <span class="title">{{$hoadon->hd_ma}}</span>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <span class="title">{{$hoadon->hd_ngaykt}}</span>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <span class="title">{{$hoadon->updated_at}}</span>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <span class="title">{{$hoadon->hd_tongtien}}</span>
                                            </span>
                                        </div>
                                        @php
                                            $tinhtrang='Chưa xác định';
                                            $color='badge-danger';
                                            switch($hoadon->hd_tinhtrang){
                                                case '2':
                                                    $tinhtrang='chưa duyệt';
                                                    $color='badge-warning';
                                                    break;
                                                case '1':
                                                    $tinhtrang='đã duyệt';
                                                    $color='badge-info';
                                                    break;
                                                case '4':
                                                    $tinhtrang='Hoàn thành';
                                                    $color='badge-success';
                                                    break;
                                                case '3':
                                                    $tinhtrang='Đã hủy';
                                                    $color='badge-danger';
                                                    break;      
                                                default:   
                                                    $tinhtrang='Từ chối';
                                                    $color='badge-danger';
                                                    break;  
                                            }
                                        @endphp
                                        <div class="nk-tb-col">
                                            <span class="dot bg-warning d-mb-none"></span>
                                            <span class="badge badge-sm badge-dot has-bg {{$color}} d-none d-mb-inline-flex">{{$tinhtrang}}</span>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="mr-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{route('admin.hoadon.cthoadoncd',['id'=>$hoadon->hd_ma])}}"><em class="icon ni ni-edit"></em><span>Sửa</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
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
                                                class="page-item {{ $hoadons->currentPage() == 1 ? ' disabled' : '' }}">
                                                <a class="page-link" href="{{ $hoadons->previousPageUrl() }}"><em
                                                        class="icon ni ni-chevrons-left"></em></a>
                                            </li>
                                            @for ($i = 1; $i <= $hoadons->lastPage(); $i++)
                                                <li
                                                    class="page-item {{ $hoadons->currentPage() == $i ? ' active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $hoadons->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li
                                                class="page-item {{ $hoadons->currentPage() == $hoadons->lastPage() ? ' disabled' : '' }}">
                                                <a class="page-link" href="{{ $hoadons->nextPageUrl() }}"><em
                                                        class="icon ni ni-chevrons-right"></em></a>
                                            </li>
                                        </ul><!-- .pagination -->
                                    </div>
                                    <div class="g">
                                    Hiển thị từ {{$hoadons->firstItem()}} đến {{$hoadons->lastItem()}} của {{$hoadons->total()}} hóa đơn
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


    <script src="{{asset('/assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/danhmucdulieu/hoadon.js')}}"></script>
    <script>

    // $(document).ready(function() {
    //         $("#keyword").keyup(function() {
    //             var keyword = $(this).val();
    //             console.log(keyword);
    //             $.ajax({
    //                 type: "GET",
    //                 url: "loaithucuong/searchltu",
    //                 data: {
    //                     keyword: keyword,
    //                 },
    //                 datatype: "JSON",
    //                 success: function(data) {
    //                     $(".searchltu").html(data);
    //                 },
    //             })
    //         });
    //     }); 
    </script>
@endsection