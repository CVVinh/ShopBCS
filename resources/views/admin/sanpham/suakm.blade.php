@extends('admin.master')
@section('content')
    <div class="nk-content ">
        <form action="{{ route('admin.sanpham.suakm',['id' => $sp->sp_ma]) }}" method="post" enctype="multipart/form-data" class="formLoaiSanPham">
            @csrf
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">Cập nhật Khuyến mãi - MSSP: {{$sp->sp_ma}}</h5>
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
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <select id="custom-labels-listbox1" name="sp_ma[]" class="dual-listbox" multiple>
                                            @foreach($khuyenmai->sanphams as $sanpham1)
                                                <option id="dv{{$sanpham1->sp_ma}}" value="{{$sanpham1->sp_ma}}" selected>{{$sanpham1->sp_ten}} ({{$sanpham1->sp_ma}})</option>
                                            @endforeach
                                            @foreach($sanphams as $sanpham)
                                                <option value="{{$sanpham->sp_ma}}">{{$sanpham->sp_ten}}({{$sanpham->sp_ma}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- .card-preview -->
                            </div>
                        </div>
                    </div>
                </div>
                    @foreach($khuyenmai->sanphams as $sanpham1)
                    <div class="row g-3" id="sanpham_ten{{$sanpham1->sp_ma}}">
                        <div class="col-5">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <label class="form-label" for="product-title">{{$sanpham1->sp_ten}}({{$sanpham1->sp_ma}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control" type="text" id="sanpham_ma{{$sanpham1->sp_ma}}"  name="phantram[{{$sanpham1->sp_ma}}]" value="{{$sanpham1->pivot->phantram}}"></input>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select class="form-control" id="mota{{$sanpham1->sp_ma}}" name="mota[{{$sanpham1->sp_ma}}]">
                                        @if($sanpham1->pivot->mota=='Giảm')
                                        <option value="Giảm" selected>Giảm</option>
                                        <option value="Tặng 1">Tặng 1</option>
                                        @else
                                        <option value="Giảm">Giảm</option>
                                        <option value="Tặng 1" selected>Tặng 1</option>
                                        @endif
                                    </select>       
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select class="form-control" id="donvi_ma{{$sanpham1->sp_ma}}" name="dv_ma[{{$sanpham1->sp_ma}}]">
                                        @foreach($sanpham1->donvis as $donvi)
                                        <option value="{{$donvi->dv_ma}}" {{$sanpham1->pivot->dv_ma==$donvi->dv_ma ? 'selected' : ''}} >{{$donvi->dv_ten}}</option>
                                        @endforeach
                                    </select>       
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @foreach($sanphams as $sanpham)
                    <div class="row g-3"  hidden id="sanpham_ten{{$sanpham->sp_ma}}">
                        <div class="col-5">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <label class="form-label" for="product-title">{{$sanpham->sp_ten}}({{$sanpham->sp_ma}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control" type="number"  id="sanpham_ma{{$sanpham->sp_ma}}"  name="phantram[{{$sanpham->sp_ma}}]" value=""></input>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select  class="form-control" id="mota{{$sanpham->sp_ma}}" name="mota[{{$sanpham->sp_ma}}]">
                                        <option value="Giảm">Giảm</option>
                                        <option value="Tăng">Tặng 1</option>
                                    </select>      
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select class="form-control" id="donvi_ma{{$sanpham->sp_ma}}" name="dv_ma[{{$sanpham->sp_ma}}]">
                                        @foreach($sanpham->donvis as $donvi)
                                        <option value="{{$donvi->dv_ma}}">{{$donvi->dv_ten}}</option>
                                        @endforeach
                                    </select>       
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                <div class="row g-3">
                    <div class="col-12">
                        <button class="btn btn-primary" id="button_update"><em
                                class="icon ni ni-plus"></em><span>Cập nhật</span></button>
                    </div>
                </div>
            </div><!-- .nk-block -->
        </form>
    </div>
@section('link-js-cuoitrang')
    <script src="{{ asset('assets/js/libs/editors/summernote.js?ver=2.5.0') }}"></script>
    <script src="{{ asset('assets/js/editors.js?ver=2.5.0') }}"></script>
    <script src="{{asset('assets/js/libs/dual-listbox.js?ver=2.5.0')}}"></script>
    {{-- <script src="{{asset('assets/js/example-listbox.js?ver=2.5.0')}}"></script> --}}
    <script>


    var customLabelsListbox = new DualListbox('#custom-labels-listbox1', {
            addEvent: function(value) {
                // console.log(value);
                document.getElementById("sanpham_ten"+value).hidden = false;
                document.getElementById("sanpham_ma"+value).hidden = false;
                document.getElementById("mota"+value).hidden = false;
            },
            removeEvent: function (value) {
                // console.log(value);
                document.getElementById("sanpham_ten"+value).hidden = true;
                document.getElementById("sanpham_ma"+value).hidden = true;
                document.getElementById("mota"+value).hidden = true;
                document.getElementById("sanpham_ma"+value).value = "";
            },
            availableTitle: 'Sản phẩm',
            selectedTitle: 'Sản phẩm đã chọn',
            addButtonText: '<em class="icon ni ni-chevron-right"></em>',
            removeButtonText: '<em class="icon ni ni-chevron-left"></em>',
            addAllButtonText: '<em class="icon ni ni-chevrons-right"></em>',
            removeAllButtonText: '<em class="icon ni ni-chevrons-left"></em>'
        });
    </script>
@endsection
@endsection
