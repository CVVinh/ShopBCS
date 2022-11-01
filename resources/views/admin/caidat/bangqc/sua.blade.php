@extends('admin.master')
@section('content')
    <div class="nk-content ">
        <form action="{{ url('admin/caidat/bangqc/sua/'.$bangqc->qc_ma) }}" method="post" enctype="multipart/form-data" class="formLoaibangqc">
            @csrf
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">Cập Nhật Hình Quảng Cáo</h5>
                    <h6 class="nk-block-title">Mã QC: {{$bangqc->qc_ma}}</h6>
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
                            <label class="form-label" for="product-title">Trạng thái</label>
                            <div class="form-control-wrap">
                                <select class="form-control" id="qc_tinhtrang" name="qc_tinhtrang">
                                    @if($bangqc->qc_tinhtrang=='1')
                                    <option value="{{$bangqc->qc_tinhtrang}}" {{$bangqc->qc_tinhtrang=='1' ? 'selected' : ''}}>Đang sử dụng</option>
                                    <option value="0">Ngừng sử dụng</option>
                                    @else
                                    <option value="{{$bangqc->qc_tinhtrang}}" {{$bangqc->qc_tinhtrang=='0' ? 'selected' : ''}}>Ngừng sử dụng</option>
                                    <option value="1">Đang sử dụng</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="qc_ten">Chọn các hình QC</label>
                            <div class="form-control-wrap">
                                <input type="file" accept="image/png, image/jpeg" name="hqc_ten[]" 
                                id="hqc_ten"
                                multiple />
                                <div id="hqc_ten1">
                                @foreach($bangqc->hinhqcs as $hinhqc)
                                    <img  src="{{asset('uploads/img/'.$hinhqc->hqc_ten) }}" alt=""class="w-25 rounded-top" id="hqc_ten">
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <button class="btn btn-primary" id="button_update"><em
                                class="icon ni ni-plus"></em><span>Cập nhật</span></button>
                    </div>
                </div>
            </div><!-- .nk-block -->
        </form>
    </div>

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

            $('#qc_hinh').on("change", previewImages);
            $('#hqc_ten').on("change", previewImages);
    </script>
@endsection
