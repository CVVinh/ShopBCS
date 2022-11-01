@extends('admin.master')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Danh mục nhà sản xuất</h3>
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
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                    data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="drodown">
                                                <a href="#"
                                                    class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                    data-toggle="dropdown">Trạng thái</a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><span>Đang hoạt động</span></a></li>
                                                        <li><a href="#"><span>Ngừng hoạt động</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-target="addProduct"
                                                class="toggle btn btn-icon btn-primary d-md-none"><em
                                                    class="icon ni ni-plus"></em></a>
                                            <a href="#" data-target="addProduct" class="toggle btn btn-primary d-none d-md-inline-flex" 
                                            onclick='
                                                        document.getElementById("nsx_ma").value="";
                                                        document.getElementById("nsx_ten").value="";
                                                        document.getElementById("nsx_sdt").value="";
                                                        document.getElementById("nsx_email").value="";
                                                        document.getElementById("nsx_diachi").value="";
                                                        document.getElementById("nsx_msthue").value="";
                                                        // document.getElementById("nsx_tinhtrang").value="";
                                                        document.getElementById("button_update").innerHTML="<em class=\"icon ni ni-plus\"></em><span>Thêm</span>";

                                                    '
                                            ><em class="icon ni ni-plus"></em><span>Thêm</span></a>
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
                                        <div class="nk-tb-col tb-col-sm"><span>Tên Nhà Sản Xuất</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Số Điện Thoại</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Email</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Địa Chỉ</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Mã Số Thuế</span></div>
                                        <div class="nk-tb-col"><span>Trạng Thái</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="mr-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                            data-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em
                                                                            class="icon ni ni-trash"></em><span>Xóa tất cả</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    @foreach($nhaSanXuats as $nhaSanXuat)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="{{$nhaSanXuat->nsx_ma}}">
                                                <label class="custom-control-label"
                                                    for="{{$nhaSanXuat->nsx_ma}}"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                {{-- <img src="./images/product/a.png" alt="" class="thumb"> --}}
                                                <span class="title">{{$nhaSanXuat->nsx_ten}}</span>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <span class="title">{{$nhaSanXuat->nsx_sdt}}</span>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <span class="title">{{$nhaSanXuat->nsx_email}}</span>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <span class="title">{{$nhaSanXuat->nsx_diachi}}</span>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <span class="title">{{$nhaSanXuat->nsx_msthue}}</span>
                                            </span>
                                        </div>
                                        @php
                                        $tinhtrang='Đang hoạt động';
                                        $color='badge-success';
                                        if($nhaSanXuat->nsx_tinhtrang!="1"){
                                        $tinhtrang='Ngừng hoạt động';
                                        $color='badge-warning';
                                        }
                                        @endphp
                                        <div class="nk-tb-col">
                                            <span class="dot bg-warning d-mb-none"></span>
                                            <span
                                                class="badge badge-sm badge-dot has-bg {{$color}} d-none d-mb-inline-flex">{{$tinhtrang}}</span>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="mr-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                            data-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#" id="{{$nhaSanXuat->nsx_ma}}" onclick="
                                                                        document.getElementById('nsx_ma').value=this.id;
                                                                        document.getElementById('nsx_ten').value='{{$nhaSanXuat->nsx_ten}}';
                                                                        document.getElementById('nsx_sdt').value='{{$nhaSanXuat->nsx_sdt}}';
                                                                        document.getElementById('nsx_email').value='{{$nhaSanXuat->nsx_email}}';
                                                                        document.getElementById('nsx_diachi').value='{{$nhaSanXuat->nsx_diachi}}';
                                                                        document.getElementById('nsx_msthue').value='{{$nhaSanXuat->nsx_msthue}}';
                                                                        document.getElementById('nsx_tinhtrang').value='{{$nhaSanXuat->nsx_tinhtrang}}';
                                                                        document.getElementById('button_update').innerHTML='<em class=\'icon ni ni-edit\'></em><span>Cập nhật</span>';
                                                                " data-target="addProduct" class="toggle"><em
                                                                            class="icon ni ni-edit"></em><span>Sửa</span></a>
                                                                </li>
                                                                <li><a
                                                                        href="{{url('admin/danhmucdulieu/nhasanxuat/xoa/'.$nhaSanXuat->nsx_ma)}}"><em
                                                                            class="icon ni ni-trash"></em><span>Xóa</span></a>
                                                                </li>
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
                                                class="page-item {{ $nhaSanXuats->currentPage() == 1 ? ' disabled' : '' }}">
                                                <a class="page-link" href="{{ $nhaSanXuats->previousPageUrl() }}"><em
                                                        class="icon ni ni-chevrons-left"></em></a>
                                            </li>
                                            @for ($i = 1; $i <= $nhaSanXuats->lastPage(); $i++)
                                                <li
                                                    class="page-item {{ $nhaSanXuats->currentPage() == $i ? ' active' : '' }}">
                                                    <a class="page-link" href="{{ $nhaSanXuats->url($i) }}">{{ $i }}</a>
                                                </li>
                                                @endfor
                                                <li
                                                    class="page-item {{ $nhaSanXuats->currentPage() == $nhaSanXuats->lastPage() ? ' disabled' : '' }}">
                                                    <a class="page-link" href="{{ $nhaSanXuats->nextPageUrl() }}"><em
                                                            class="icon ni ni-chevrons-right"></em></a>
                                                </li>
                                        </ul><!-- .pagination -->
                                    </div>
                                    <div class="g">
                                    Hiển thị từ {{$nhaSanXuats->firstItem()}} đến {{$nhaSanXuats->lastItem()}} của {{$nhaSanXuats->total()}} nhà sản xuất
                                    </div><!-- .pagination-goto -->
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
                <form action="{{url('admin/danhmucdulieu/nhasanxuat/them')}}" method="post"
                    enctype="multipart/form-data" class="formNhaSanXuat">
                    @csrf
                    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct"
                        data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">Thêm danh mục nhà sản xuất</h5>
                                <div class="nk-block-des">
                                    <p>Thêm mới danh mục nhà sản xuất</p>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="nsx_ten">Tên nhà sản xuất</label>
                                        <div class="form-control-wrap">
                                            <input hidden type="text" class="form-control" id="nsx_ma" name="nsx_ma"
                                                value="">
                                            <input type="text" class="form-control" name="nsx_ten" id="nsx_ten"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="nsx_sdt">Số điện thoại</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="nsx_sdt" id="nsx_sdt"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="nsx_email">Email</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="nsx_email" id="nsx_email"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="nsx_diachi">Địa chỉ</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="nsx_diachi" id="nsx_diachi"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="nsx_msthue">Mã số thuế</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="nsx_msthue" id="nsx_msthue"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="nsx_tinhtrang">Trạng thái</label>
                                        <div class="form-control-wrap">
                                            <select class="form-control" id="nsx_tinhtrang" name="nsx_tinhtrang">
                                                <option value="1">Đang hoạt động</option>
                                                <option value="0">Ngừng hoạt động</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary" id="button_update"><em
                                            class="icon ni ni-plus"></em><span>Thêm</span></button>
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
<script src="{{asset('js/danhmucdulieu/nhaSanXuat.js')}}"></script>
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