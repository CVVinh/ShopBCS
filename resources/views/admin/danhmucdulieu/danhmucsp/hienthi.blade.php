@extends('admin.master')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Danh mục sản phẩm</h3>
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
                                            <a href="#" data-target="addProduct" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-target="addProduct" class="toggle btn btn-primary d-none d-md-inline-flex" onclick='
                                            document.getElementById("dm_ma").value="";
                                            document.getElementById("dm_ten").value="";
                                            // document.getElementById("dm_tinhtrang").value="";
                                            document.getElementById("button_update").innerHTML="<em class=\"icon ni ni-plus\"></em><span>Thêm</span>";

                                    '><em class="icon ni ni-plus"></em><span>Thêm</span></a>
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
                                        <div class="nk-tb-col tb-col-sm"><span>Tên Danh Mục Sản Phẩm</span></div>
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
                                    @foreach($danhmucsps as $danhmucsp)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="{{$danhmucsp->dm_ma}}">
                                                <label class="custom-control-label" for="{{$danhmucsp->dm_ma}}"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                {{-- <img src="./images/product/a.png" alt="" class="thumb"> --}}
                                                <span class="title">{{$danhmucsp->dm_ten}}</span>
                                            </span>
                                        </div>
                                        @php
                                            $tinhtrang='Đang sử dụng';
                                            $color='badge-success';
                                            if($danhmucsp->dm_tinhtrang!="1"){
                                                $tinhtrang='Ngừng sử dụng';
                                                $color='badge-warning';
                                            }
                                        @endphp
                                        <div class="nk-tb-col">
                                            <span class="dot bg-warning d-mb-none"></span>
                                            {{-- <span class="badge badge-sm badge-dot has-bg badge-success d-none d-mb-inline-flex">Ngừng sử dụng</span> --}}
                                            <span class="badge badge-sm badge-dot has-bg {{$color}} d-none d-mb-inline-flex">{{$tinhtrang}}</span>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="mr-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#" id="{{$danhmucsp->dm_ma}}" onclick='
                                                                        document.getElementById("dm_ma").value=this.id;
                                                                        document.getElementById("dm_ten").value="{{$danhmucsp->dm_ten}}";
                                                                        document.getElementById("dm_tinhtrang").value="{{$danhmucsp->dm_tinhtrang}}";
                                                                        document.getElementById("button_update").innerHTML="<em class=\"icon ni ni-edit\"></em><span>Cập nhật</span>";

                                                                        
                                                                ' data-target="addProduct" class="toggle"><em class="icon ni ni-edit"></em><span>Sửa</span></a></li>
                                                                <li><a href="{{url('admin/danhmucdulieu/danhmucsp/xoa/'.$danhmucsp->dm_ma)}}"><em class="icon ni ni-trash"></em><span>Xóa</span></a></li>
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
                                                class="page-item {{ $danhmucsps->currentPage() == 1 ? ' disabled' : '' }}">
                                                <a class="page-link" href="{{ $danhmucsps->previousPageUrl() }}"><em
                                                        class="icon ni ni-chevrons-left"></em></a>
                                            </li>
                                            @for ($i = 1; $i <= $danhmucsps->lastPage(); $i++)
                                                <li
                                                    class="page-item {{ $danhmucsps->currentPage() == $i ? ' active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $danhmucsps->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li
                                                class="page-item {{ $danhmucsps->currentPage() == $danhmucsps->lastPage() ? ' disabled' : '' }}">
                                                <a class="page-link" href="{{ $danhmucsps->nextPageUrl() }}"><em
                                                        class="icon ni ni-chevrons-right"></em></a>
                                            </li>
                                        </ul><!-- .pagination -->
                                    </div>
                                    <div class="g">
                                    Hiển thị từ {{$danhmucsps->firstItem()}} đến {{$danhmucsps->lastItem()}} của {{$danhmucsps->total()}} sản phẩm
                                    </div>
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
                <form action="{{url('admin/danhmucdulieu/danhmucsp/them')}}" method="post" enctype="multipart/form-data" class="formDanhMucSP">
                    @csrf
                    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">Thêm danh mục sản phẩm</h5>
                                <div class="nk-block-des">
                                    <p>Thêm mới danh mục sản phẩm</p>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="product-title">Tên danh mục sản phẩm</label>
                                        <div class="form-control-wrap">
                                            <input hidden type="text" class="form-control" id="dm_ma" name="dm_ma" value="">
                                            <input type="text" class="form-control" name="dm_ten" id="dm_ten">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="product-title">Trạng thái</label>
                                        <div class="form-control-wrap">
                                            <select class="form-control" id="dm_tinhtrang" name="dm_tinhtrang">
                                                <option value="1">Đang sử dụng</option>
                                                <option value="0">Ngừng sử dụng</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary" id="button_update"><em class="icon ni ni-plus"></em><span>Thêm</span></button>
                                </div>
                            </div>
                        </div><!-- .nk-block -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <script src="{{asset('/assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/danhmucdulieu/danhMucSP.js')}}"></script>
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