<section class="nav-left">
    <div class="container">

        @if (session('thongBaoChaoMung'))
        <div class="alert alert-success thongbao" role="alert">
            {{ session('thongBaoChaoMung') }}
        </div>
        @endif

        <div class="nav-container">
            <ul class="nav flex-column nav-lefts">
                @foreach($danhMucSPs as $danhMucSP)
                <li class="nav-item nav-item--icon font-awesome-icons">
                    <a class="nav-link" >{{$danhMucSP->dm_ten}}</a>
                    <ul class="dropdown-right">
                        @foreach($danhMucSP->loaisp as $loaiSP)
                            @if($loaiSP->lsp_ma!==1)
                            <li class="nav-item">
                                <a class="nav-link" href="/khachHang/thongTinSP/xemToanBoSP/{{$loaiSP->lsp_ma}}">{{$loaiSP->lsp_ten}}</a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{asset('uploads/qc1.png')}}"
                            class="d-block w-100" alt="..." />
                    </div>
                    @foreach($quangCaoHeader->hinhqcs as $qcHeader)
                    <div class="carousel-item">
                        <img src="{{asset('uploads/'.$qcHeader->hqc_ten)}}"
                            class="d-block w-100" alt="..." />
                    </div>
                    @endforeach
                    
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Trước</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Tiếp</span>
                </button>
            </div>
        </div>
    </div>
</section>