@extends('admin.master')
@section('content')
    <div class="nk-content ">
        <form action="{{ route('admin.sanpham.sale.them') }}" method="post" enctype="multipart/form-data" class="formLoaiSanPham">
            @csrf
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">Thêm Sale</h5>
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
                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label" for="product-title">Ngày bắt đầu</label>
                            <div class="form-control-wrap">
                                <input type="datetime-local" name="sale_tgbd" id="" style="width:100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label" for="product-title">Ngày kết thúc</label>
                            <div class="form-control-wrap">
                                <input type="datetime-local" name="sale_tgkt" id="" style="width:100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label" for="product-title">Mô tả</label>
                            <div class="form-control-wrap">
                                <input type="text" name="sale_noidung" id="" style="width:100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-10">
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
                    <div class="col-2">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                    @foreach($sanphams as $sanpham)
                                        <label class="form-label" id="sanpham_ten{{$sanpham->sp_ma}}" hidden for="product-title">{{$sanpham->sp_ten}} ({{$sanpham->sp_ma}})</label>
                                        <input type="text" id="sanpham_ma{{$sanpham->sp_ma}}" placeholder="Nhập % giảm giá" hidden name="giamgia[{{$sanpham->sp_ma}}]"></input>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" id="button_update"><em
                                class="icon ni ni-plus"></em><span>Thêm</span></button>
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
