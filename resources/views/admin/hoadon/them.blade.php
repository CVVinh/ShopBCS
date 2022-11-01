@extends('admin.master')
@section('content')
    <div class="nk-content ">
        <form action="{{ route('admin.phieunhap.them') }}" method="post" enctype="multipart/form-data" class="formLoaiSanPham">
            @csrf
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">Tạo phiếu nhập</h5>
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
                                            @foreach($sanphams as $sanpham)
                                                <option id=dv value="{{$sanpham->sp_ma}}">{{$sanpham->sp_ten}}({{$sanpham->sp_ma}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- .card-preview -->
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($sanphams as $sanpham)
                    <div class="row g-3"  hidden id="sanpham_ten{{$sanpham->sp_ma}}">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <label class="form-label" for="product-title">{{$sanpham->sp_ten}}({{$sanpham->sp_ma}})</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control" type="number" placeholder="Số lượng"   id="sanpham_ma{{$sanpham->sp_ma}}"  name="soluong[{{$sanpham->sp_ma}}]" value=""></input>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input class="form-control" type="number" placeholder="Giá nhập"   id="sanpham_ma{{$sanpham->sp_ma}}"  name="gianhap[{{$sanpham->sp_ma}}]" value=""></input>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div class="row g-3">
                        <div class="col-12">
                            <button class="btn btn-primary" id="button_update"><em
                                    class="icon ni ni-plus"></em><span>Tạo</span></button>
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
            },
            removeEvent: function (value) {
                // console.log(value);
                document.getElementById("sanpham_ten"+value).hidden = true;
                document.getElementById("sanpham_ma"+value).hidden = true;
                document.getElementById("sanpham_ma"+value).value = "";
            },
            availableTitle: 'Sản phẩm',
            selectedTitle: 'Sản phẩm được chọn',
            addButtonText: '<em class="icon ni ni-chevron-right"></em>',
            removeButtonText: '<em class="icon ni ni-chevron-left"></em>',
            addAllButtonText: '<em class="icon ni ni-chevrons-right"></em>',
            removeAllButtonText: '<em class="icon ni ni-chevrons-left"></em>'
        });
    </script>
@endsection
@endsection
