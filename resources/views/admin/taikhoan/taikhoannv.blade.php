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
                                        <div class="nk-tb-col tb-col-sm"><span>Tên người dùng</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Tên tài khoản</span></div>
                                        <div class="nk-tb-col"><span>Trạng thái</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools">Khóa</div>
                                        <div class="nk-tb-col nk-tb-col-tools">Mở khóa</div>
                                    </div><!-- .nk-tb-item -->
                                    @foreach($nhanviens as $nhanvien)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="{{$nhanvien->nv_ma}}">
                                                <label class="custom-control-label" for="{{$nhanvien->nv_ma}}"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                {{-- <img src="./images/product/a.png" alt="" class="thumb"> --}}
                                                <span class="title">{{$nhanvien->ten}}</span>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                {{-- <img src="./images/product/a.png" alt="" class="thumb"> --}}
                                                <span class="title">{{$nhanvien->sdt != null ? $nhanvien->sdt : $nhanvien->email}}</span>
                                            </span>
                                        </div>
                                        @php
                                            $tinhtrang='Đang sử dụng';
                                            $color='badge-success';
                                            if($nhanvien->tinhtrang!="1"){
                                                $tinhtrang='đã khóa';
                                                $color='badge-warning';
                                            }
                                        @endphp
                                        <div class="nk-tb-col">
                                            <span class="dot bg-warning d-mb-none"></span>
                                            <span class="badge badge-sm badge-dot has-bg {{$color}} d-none d-mb-inline-flex">{{$tinhtrang}}</span>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <button id={{$nhanvien->nv_ma.'khoa'}} name="khoa" onclick="khoa(this);" value="{{$nhanvien->nv_ma}}" >Khóa</button>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <button id={{$nhanvien->nv_ma.'mokhoa'}} name="mokhoa" onclick="khoa(this);" value="{{$nhanvien->nv_ma}}">Mở khóa</button>
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
                                                class="page-item {{ $nhanviens->currentPage() == 1 ? ' disabled' : '' }}">
                                                <a class="page-link" href="{{ $nhanviens->previousPageUrl() }}"><em
                                                        class="icon ni ni-chevrons-left"></em></a>
                                            </li>
                                            @for ($i = 1; $i <= $nhanviens->lastPage(); $i++)
                                                <li
                                                    class="page-item {{ $nhanviens->currentPage() == $i ? ' active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $nhanviens->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li
                                                class="page-item {{ $nhanviens->currentPage() == $nhanviens->lastPage() ? ' disabled' : '' }}">
                                                <a class="page-link" href="{{ $nhanviens->nextPageUrl() }}"><em
                                                        class="icon ni ni-chevrons-right"></em></a>
                                            </li>
                                        </ul><!-- .pagination -->
                                    </div>
                                    <div class="g">
                                    Hiển thị từ {{$nhanviens->firstItem()}} đến {{$nhanviens->lastItem()}} của {{$nhanviens->total()}} sản phẩm
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
<script>
    function khoa(input){
        var name=input.name;
        var value=input.value;
        console.log(name);
        $.ajax({
                    type: "GET",
                    url: `/api/taikhoannv/sua`,
                    data: {
                        name: name,value:value,
                    },
                    datatype: "JSON",
                    success: function() {
                        alert('Cập nhật thành công!');
                        window.location.reload();
                    },
                })
    }
</script>
@endsection