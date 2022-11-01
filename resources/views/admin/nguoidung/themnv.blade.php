@extends('admin.master')
@section('content')
<div class="nk-content ">
    <form action="{{route('admin.nguoidung.themnv')}}" method="post"
    enctype="multipart/form-data" class="formLoaiSanPham">
    @csrf
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Thêm nhân viên</h5>
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
                        <label class="form-label" for="hinh">Hình đại diện</label>
                        <div class="form-control-wrap">
                            <div id="hinh1">
                                <img  
                                src="" 
                                alt="" class="w-25 rounded-top">
                            </div>
                            <input
                            type="file"
                            accept="image/png, image/jpeg"
                            name="hinh"
                            value=""
                            id="hinh"
                            />
                            
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label" for="ten">Tên khách hàng</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="ten" value=""/>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label" for="gioitinh">Giới tính</label>
                        <div class="form-control-wrap">
                            <select name="gioitinh" class="form-control">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label" for="ngaysinh">Ngày sinh</label>
                        <div class="form-control-wrap">
                            <input type="date" class="form-control" name="ngaysinh" value="">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label" for="sdt">Số điện thoại</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="sdt" value="">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label" for="email">email</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="email" value="">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label" for="cccd">cccd</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="cccd" value="">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label" for="diachi">diachi</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="diachi" value="">
                        </div>
                    </div>
                </div>
                
                </div><!-- .nk-block -->
            <br>
           
                <div class="col-12">
                    <button class="btn btn-primary" id="button_update" ><em class="icon ni ni-plus"></em><span>Thêm</span></button>
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

            $('#hinh').on("change", previewImages);
        
    </script>
@endsection
@endsection