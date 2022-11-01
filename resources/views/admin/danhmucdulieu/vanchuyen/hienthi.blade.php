@extends('admin.master')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title" vận chuyển</h3>
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
                                            <a href="#" data-target="addProduct"
                                                class="toggle btn btn-primary d-none d-md-inline-flex" 
                                                 onclick="
                                                        document.getElementById('vc_ma').value='';
                                                        document.getElementById('vc_ten').value='';
                                                        document.getElementById('vc_hinh2').src='';
                                                        document.getElementById('button_update').innerHTML='<em class=\'icon ni ni-plus\'></em><span>Thêm</span>';
                                                    "
                                                ><em
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
                                        <div class="nk-tb-col tb-col-sm"><span>Tên Đơn Vị Vận Chuyển</span></div>
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
                                    @foreach($vanchuyens as $vanchuyen)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="{{$vanchuyen->vc_ma}}">
                                                <label class="custom-control-label" for="{{$vanchuyen->vc_ma}}"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <img src="{{ asset('/uploads/img/'.$vanchuyen->vc_hinh) }}"
                                                    alt="" class="thumb">
                                                <span class="title">{{ $vanchuyen->vc_ten }}</span>
                                            </span>
                                        </div>
                                        @php
                                        $tinhtrang='Đang hoạt động';
                                        $color='badge-success';
                                        if($vanchuyen->vc_tinhtrang!="1"){
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
                                                                <li><a href="#" id="{{$vanchuyen->vc_ma}}" onclick="

                                                                        document.getElementById('vc_ma').value=this.id;
                                                                        document.getElementById('vc_ten').value='{{$vanchuyen->vc_ten}}';
                                                                        document.getElementById('vc_hinh2').src='{{asset('uploads/img/'.$vanchuyen->vc_hinh)}}';
                                                                        document.getElementById('vc_tinhtrang').value='{{$vanchuyen->vc_tinhtrang}}';
                                                                        document.getElementById('button_update').innerHTML='<em class=\'icon ni ni-edit\'></em><span>Cập nhật</span>';
                                                                " data-target="addProduct" class="toggle"><em
                                                                            class="icon ni ni-edit"></em><span>Sửa</span></a>
                                                                </li>
                                                                <li><a
                                                                        href="{{url('admin/danhmucdulieu/vanchuyen/xoa/'.$vanchuyen->vc_ma)}}"><em
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
                                            <li class="page-item {{ $vanchuyens->currentPage() == 1 ? ' disabled' : '' }}">
                                                <a class="page-link" href="{{ $vanchuyens->previousPageUrl() }}"><em
                                                        class="icon ni ni-chevrons-left"></em></a>
                                            </li>
                                            @for ($i = 1; $i <= $vanchuyens->lastPage(); $i++)
                                                <li
                                                    class="page-item {{ $vanchuyens->currentPage() == $i ? ' active' : '' }}">
                                                    <a class="page-link" href="{{ $vanchuyens->url($i) }}">{{ $i }}</a>
                                                </li>
                                                @endfor
                                                <li
                                                    class="page-item {{ $vanchuyens->currentPage() == $vanchuyens->lastPage() ? ' disabled' : '' }}">
                                                    <a class="page-link" href="{{ $vanchuyens->nextPageUrl() }}"><em
                                                            class="icon ni ni-chevrons-right"></em></a>
                                                </li>
                                        </ul><!-- .pagination -->
                                    </div>
                                    <div class="g">
                                    Hiển thị từ {{$vanchuyens->firstItem()}} đến {{$vanchuyens->lastItem()}} của {{$vanchuyens->total()}} đơn vị vận chuyển
                                    </div><!-- .pagination-goto -->
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
                <form action="{{url('admin/danhmucdulieu/vanchuyen/them')}}" method="post" enctype="multipart/form-data"
                    class="formPhuongThucVanChuyen">
                    @csrf
                    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct"
                        data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">Thêm vận chuyển</h5>
                                <div class="nk-block-des">
                                    <p>Thêm mới vận chuyển</p>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="vc_ten">Tên vận chuyển</label>
                                        <div class="form-control-wrap">
                                            <input hidden type="text" class="form-control" id="vc_ma" name="vc_ma"
                                                value="">
                                            <input type="text" class="form-control" name="vc_ten" id="vc_ten" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="vc_hinh">Chọn hình đại diện</label>
                                    <input 
                                        type="file" 
                                        accept="image/png, image/jpeg" 
                                        name="vc_hinh"
                                        id="vc_hinh" />
                                    <div id="vc_hinh1">
                                        <img  
                                            id="vc_hinh2"
                                            src="{{asset('uploads/img/'.$vanchuyen->vc_hinh) }}" 
                                            alt="" class="w-25 rounded-top">                                         
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="vc_tinhtrang">Trạng thái</label>
                                        <div class="form-control-wrap">
                                            <select class="form-control" id="vc_tinhtrang" name="vc_tinhtrang">
                                                <option value="1">Đang hoạt động</option>
                                                <option value="0">Ngừng hoạt động</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary"id="button_update" ><em
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
<script src="{{asset('js/danhmucdulieu/vanChuyen.js')}}"></script>
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

        $('#vc_hinh').on("change", previewImages);
    
</script>
@endsection