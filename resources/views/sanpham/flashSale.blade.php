<section id="flash-sale" class="pb-3 mb-3">
    @if(isset($spSales))
    <div class="container">
        <div class="flash-container pb-3">
            <div class="d-flex align-items-center justify-content-between bg-flash">
                <div class="flash-title p-3 d-flex align-items-center justify-content-between gap-4">
                    <div class="position-relative">
                        <img src="https://theme.hstatic.net/1000343028/1000824661/14/flash-sale.svg?v=337"
                            alt="flash-sale" class="flash-img" alt="Ảnh Mẫu" />
                        <img src="https://theme.hstatic.net/1000343028/1000824661/14/bolt.svg?v=337" alt="Ảnh Mẫu"
                            class="flash flash-img" />
                    </div>
                    <!-- <div class="countdown" data-time="Tue May 31 2022 07:27:45"> -->
                    <div class="countdown" data-time="{{$spSales->sale_tgkt}}">
                        <div class="countdown-item">
                            <span class="countdown-number days">00</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-number hours">00</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-number minutes">00</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-number seconds">00</span>
                        </div>
                    </div>
                </div>
                <a href="/khachHang/thongTinSP/xemToanBoSP/flashSale"
                    class="text-reset text-decoration-none extend pr-2 text-danger">
                    <strong class="text-danger">
                        <span class=" extend-md">Xem toàn bộ sản phẩm</span>
                        <span class="extend_small">Xem thêm</span>
                        <i style="margin-right: 10px;" class="fa fa-angle-right" aria-hidden="true"></i>
                    </strong>
                </a>
            </div>

            <ul class="product-list">

                @foreach($spSales->sanphams as $sanpham)
                <li class="product-item">
                    @php 
                    $kiemTraSPKhuyenMai = App\Models\khuyenmai::where('sp_ma',$sanpham->sp_ma)->where('km_tinhtrang',1)->first();
                    @endphp
                    @if($kiemTraSPKhuyenMai)
                    <!-- <div class=" h-100">
                        <img style="z-index: 4;" src="{{asset('uploads/gift.svg')}}" alt="">
                    </div> -->
                    @endif
                    <a href="/khachHang/thongTinSP/chiTietSP/{{$sanpham->sp_ma}}" class="text-decoration-none text-reset">
                        <img class="product-item-img" src="{{asset('uploads/'.$sanpham->sp_hinh)}}" alt="Ảnh Mẫu" />
                        <h5 class="text-break text_extend">
                            {{$sanpham->sp_ten.' - '.$sanpham->donvis[0]->dv_ten.' - '.$sanpham->sp_ma}}
                        </h5>
                        <p>
                            {{number_format($sanpham->donvis[0]->pivot->giaban - ($sanpham->donvis[0]->pivot->giaban*$sanpham->donvis[0]->pivot->giamgia/100)) }}đ
                            <span class="badge bg-danger">- {{$sanpham->donvis[0]->pivot->giamgia}}%</span>
                        </p>
                        @php
                        $cthd=App\Models\cthoadon::where('sp_ma',$sanpham->sp_ma)->get()->sum('soluong')
                        @endphp
                        <span
                            class="text-decoration-line-through">{{ number_format($sanpham->donvis[0]->pivot->giaban) }}
                            đ</span>
                        <div class="d-flex align-items-center gap-2 product-item__review">
                            @php
                            $laySP = App\Models\danhgia::where('sp_ma', $sanpham->sp_ma)->sum('sosao');
                            $laySoKH = App\Models\danhgia::where('sp_ma', $sanpham->sp_ma)->count('kh_ma');
                            if($laySoKH==0){
                                $soSaoDanhGia = 0;
                            }else {
                                $soSaoDanhGia = ceil((float)$laySP/(float)$laySoKH);
                            }
                            $soSaoChuaDanhGia = 5 - $soSaoDanhGia;
                            @endphp
                            <div class="review-stars text-warning">
                                @for($i=0; $i<$soSaoDanhGia; $i++)
                                <i class="fa fa-star" aria-hidden="true"></i>
                                @endfor
                                @for($i=0; $i<$soSaoChuaDanhGia; $i++)
                                <i class="fa fa-star" aria-hidden="true" style="color:black;"></i>
                                @endfor
                                
                            </div>
                            <span>|</span>
                            <span>Đã bán {{$cthd}}</span>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</section>