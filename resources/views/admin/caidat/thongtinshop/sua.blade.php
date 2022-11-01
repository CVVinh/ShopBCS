@extends('admin.master')
@section('content')
<div class="nk-content ">
    <form action="{{url('admin/caidat/thongtinshop/sua')}}" method="post"
    enctype="multipart/form-data" class="formLoaiSanPham">
    @csrf
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Sửa Thông Tin Shop</h5>
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
                        <label class="form-label" for="lsp_ten">Tên Shop</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="shop_ten" value="{{$thongtinshop->shop_ten}}" />
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label" for="lsp_ten">Số Điện thoại</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="shop_sdt" value="{{$thongtinshop->shop_sdt}}" />
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label" for="lsp_ten">Địa Chỉ</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="shop_diachi" value="{{$thongtinshop->shop_diachi}}">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label" for="lsp_ten">Email</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="shop_email" value="{{$thongtinshop->shop_email}}">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label" for="lsp_ten">Màu Giao Diện</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="shop_maugd" value="{{$thongtinshop->shop_maugd}}">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label" for="lsp_ten">Logo</label>
                        <div class="form-control-wrap">
                            <input
                            type="file"
                            accept="image/png, image/jpeg"
                            name="shop_logo"
                            value="{{$thongtinshop->shop_logo}}"
                            id="shop_logo"
                            />
                            <div id="shop_logo1">
                                <img  
                                src="{{asset('uploads/img/'.$thongtinshop->shop_logo) }}" 
                                alt="" class="w-25 rounded-top">
                            </div>
                        </div>
                    </div>
                </div>
              
                
                </div><!-- .nk-block -->
            <br>
           
                <div class="col-12">
                    <button class="btn btn-primary" id="button_update" ><em class="icon ni ni-plus"></em><span>Sửa</span></button>
                </div>
            </div>
        </div><!-- .nk-block -->
</form>
</div>
@section('link-js-cuoitrang')
    <script src="{{asset('assets/js/libs/editors/summernote.js?ver=2.5.0')}}"></script>
    <script src="{{asset('assets/js/editors.js?ver=2.5.0')}}"></script>
    
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

            $('#shop_logo').on("change", previewImages);
        
    </script>
@endsection
@endsection