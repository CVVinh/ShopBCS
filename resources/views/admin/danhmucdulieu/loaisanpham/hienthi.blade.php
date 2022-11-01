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
                                                            <li><a href="#"><span>Đang sử dụng</span></a></li>
                                                            <li><a href="#"><span>Ngừng sử dụng</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nk-block-tools-opt">
                                                <a href="#" data-target="addProduct"
                                                    class="toggle btn btn-icon btn-primary d-md-none"><em
                                                        class="icon ni ni-plus"></em></a>
                                                <a href="#" data-target="addProduct"
                                                    class="toggle btn btn-primary d-none d-md-inline-flex"
                                                    onclick='
                                                            document.getElementById("lsp_ma").value="";
                                                            document.getElementById("lsp_ten").value="";
                                                            document.getElementById("lsp_hinh").value="";
                                                            document.getElementById("lsp_hinh1").src="";
                                                            // document.getElementById("lsp_tinhtrang").value="";
                                                            document.getElementById("dm_ma").value="";
                                                            document.getElementById("button_update").innerHTML="<em class=\"icon ni ni-plus\"></em><span>Thêm</span>";

                                                                        
                                                        '><em
                                                        class="icon ni ni-plus"></em><span>Thêm</span></a>
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
                                            <div class="nk-tb-col tb-col-sm"><span>Tên Danh Mục Loại Sản Phẩm</span></div>
                                            <div class="nk-tb-col"><span>Trạng thái</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1 my-n1">
                                                    <li class="mr-n1">
                                                        <div class="dropdown">
                                                            <a href="#"
                                                                class="dropdown-toggle btn btn-icon btn-trigger"
                                                                data-toggle="dropdown"><em
                                                                    class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="#"><em
                                                                                class="icon ni ni-trash"></em><span>Xóa tất
                                                                                cả</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                        @foreach ($loaisps as $loaisp)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="{{ $loaisp->lsp_ma }}">
                                                        <label class="custom-control-label"
                                                            for="{{ $loaisp->lsp_ma }}"></label>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm">
                                                    <span class="tb-product">
                                                        <img src="{{ asset('/uploads/img/'.$loaisp->lsp_hinh) }}"
                                                            alt="" class="thumb">
                                                        <span class="title">{{ $loaisp->lsp_ten }}</span>
                                                    </span>
                                                </div>
                                                @php
                                                    $tinhtrang='Đang sử dụng';
                                                    $color='badge-success';
                                                    if ($loaisp->lsp_tinhtrang != '1') {
                                                        $tinhtrang='Ngừng sử dụng';
                                                        $color='badge-warning';
                                                    }
                                                @endphp
                                                <div class="nk-tb-col">
                                                    <span class="dot bg-warning d-mb-none"></span>
                                                    {{-- <span class="badge badge-sm badge-dot has-bg badge-success d-none d-mb-inline-flex">Ngừng sử dụng</span> --}}
                                                    <span
                                                        class="badge badge-sm badge-dot has-bg {{ $color }} d-none d-mb-inline-flex">{{ $tinhtrang }}</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1 my-n1">
                                                        <li class="mr-n1">
                                                            <div class="dropdown">
                                                                <a href="#"
                                                                    class="dropdown-toggle btn btn-icon btn-trigger"
                                                                    data-toggle="dropdown"><em
                                                                        class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="#"
                                                                                id="{{ $loaisp->lsp_ma }}"
                                                                                onclick='
                                                                        document.getElementById("lsp_ma").value=this.id;
                                                                        document.getElementById("lsp_ten").value="{{ str_replace($loaisp->danhmucsp->dm_ten." ","",$loaisp->lsp_ten) }}";
                                                                        document.getElementById("lsp_tinhtrang").value="{{ $loaisp->lsp_tinhtrang }}";
                                                                        document.getElementById("dm_ma").value="{{ $loaisp->dm_ma }}";
                                                                        document.getElementById("button_update").innerHTML="<em class=\"icon ni ni-edit\"></em><span>Cập nhật</span>";

                                                                        
                                                                '
                                                                                data-target="addProduct"
                                                                                class="toggle"><em
                                                                                    class="icon ni ni-edit"></em><span>Sửa</span></a>
                                                                        </li>
                                                                        <li><a
                                                                                href="{{ url('admin/danhmucdulieu/loaisanpham/xoa/' . $loaisp->lsp_ma) }}"><em
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
                                                    class="page-item {{ $loaisps->currentPage() == 1 ? ' disabled' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $loaisps->previousPageUrl() }}"><em
                                                            class="icon ni ni-chevrons-left"></em></a>
                                                </li>
                                                @for ($i = 1; $i <= $loaisps->lastPage(); $i++)
                                                    <li
                                                        class="page-item {{ $loaisps->currentPage() == $i ? ' active' : '' }}">
                                                        <a class="page-link"
                                                            href="{{ $loaisps->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endfor
                                                <li
                                                    class="page-item {{ $loaisps->currentPage() == $loaisps->lastPage() ? ' disabled' : '' }}">
                                                    <a class="page-link" href="{{ $loaisps->nextPageUrl() }}"><em
                                                            class="icon ni ni-chevrons-right"></em></a>
                                                </li>
                                            </ul><!-- .pagination -->
                                        </div>
                                        <div class="g">
                                            Hiển thị từ {{ $loaisps->firstItem() }} đến {{ $loaisps->lastItem() }}
                                            của {{ $loaisps->total() }} loại sản phẩm
                                        </div>
                                    </div><!-- .nk-block-between -->
                                </div>
                            </div>
                        </div>
                    </div><!-- .nk-block -->
                    <form action="{{ url('admin/danhmucdulieu/loaisanpham/them') }}" method="post"
                        enctype="multipart/form-data" class="formLoaiSanPham">
                        @csrf
                        <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct"
                            data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h5 class="nk-block-title">Thêm danh mục loại sản phẩm</h5>
                                    <div class="nk-block-des">
                                        <p>Thêm mới danh mục loại sản phẩm</p>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="lsp_ten">Tên danh mục loại sản phẩm</label>
                                            <div class="form-control-wrap">
                                                <input hidden type="text" class="form-control" id="lsp_ma"
                                                    name="lsp_ma" value="">
                                                <input type="text" class="form-control" id="lsp_ten"
                                                    name="lsp_ten">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="product-title">Chọn danh mục sản phẩm</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="dm_ma" name="dm_ma">
                                                    @foreach ($danhmucsps as $danhmucsp)
                                                        <option value="{{ $danhmucsp->dm_ma }}">
                                                            {{ $danhmucsp->dm_ten }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="lsp_hinh">Chọn hình đại diện</label>
                                        {{-- <div class="upload-zone small bg-lighter my-2">
                                        <div class="dz-message">
                                            <span class="dz-message-text">Kéo và thả file</span>
                                        </div> --}}
                                        <input 
                                            type="file" 
                                            accept="image/png, image/jpeg" 
                                            name="lsp_hinh"
                                            id="lsp_hinh" />
                                        <div id="lsp_hinh1">
                                            <img  
                                                src="{{asset('uploads/img/'.$loaisp->lsp_hinh) }}" 
                                                alt="" class="w-25 rounded-top">                                         
                                        </div>
                                        {{-- </div> --}}
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="product-title">Trạng thái</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="lsp_tinhtrang" name="lsp_tinhtrang">
                                                    <option value="1">Đang sử dụng</option>
                                                    <option value="0">Ngừng sử dụng</option>
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


    <script src="{{ asset('/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/danhmucdulieu/loaiSP.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#keyword").keyup(function() {
                var keyword = $(this).val();
                console.log(keyword);
                $.ajax({
                    type: "GET",
                    url: "loaithucuong/searchltu",
                    data: {
                        keyword: keyword,
                    },
                    datatype: "JSON",
                    success: function(data) {
                        $(".searchltu").html(data);
                    },
                })
            });
        });
    </script>
     <script>
        function previewImages(input) {
            var id = '#'+this.id+'1';
            var $preview = $(id).empty();

            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {
                
                if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
                    return alert(file.name +" is not an image");
                } // else...
                
                var reader = new FileReader();

                $(reader).on("load", function() {
                    $preview.append($("<img/>", {src:this.result, height:100}));
                });

                reader.readAsDataURL(file);
                
            }

        }

            $('#lsp_hinh').on("change", previewImages);
        
    </script>
@endsection
