<div class="info__welcome">
    <!-- <h5 class="info___welcome-heading">Xin chào</h5> -->
    <ul class="info__list">
        <li>
            <div class="accinfo">
                <div class="myaccount">
                    <div class="myaccount__img">
                        @if(auth()->guard('kh')->user() && auth()->guard('kh')->user()->hinh!=null)
                        <img src="{{asset('avatar/'.auth()->guard('kh')->user()->hinh)}}" alt="avatar" />
                        @else
                        <img src="{{asset('avatar/avatar.png')}}" alt="avatar" />
                        @endif
                    </div>
                    <div class="myaccount__content">
                        <p>{{auth()->guard('kh')->user()->ten}}</p>
                        <a class="info__list-item-link menu_suaHoSoKH" href="/khachHang/hoSo/hoSoCaNhan">Sửa Hồ Sơ</a>
                    </div>
                </div>
                <div class="content">
                    <div class="content_acc"></div>
                </div>
            </div>
        </li>

        <li>
            <a class="info__list-item-link menu_themDiaChi" href="#"
                onclick="$('#formIDKHThemDiaChi').trigger('submit')">
                <i class="fa fa-map-marker" aria-hidden="true"></i>Thêm địa chỉ
            </a>
        </li>
        <li>
            <a class="info__list-item-link menu_donHangCuaToi" href="#"
                onclick="$('#formIDKHDonHangCuaToi').trigger('submit')">
                <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>Đơn hàng của tôi
            </a>
        </li>
        <li>
            <a class="info__list-item-link menu_gioHangCuaToi" href="#"
                onclick="$('#formIDKHGioHang').trigger('submit')">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>Giỏ hàng của tôi
            </a>
        </li>
        <li>
            <a class="info__list-item-link menu_lichSuMuaHang" href="#"
                onclick="$('#formIDKHTatCaDonHang').trigger('submit');">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>Lịch sử mua hàng
            </a>
        </li>
        <li>
            <a class="info__list-item-link menu_dangXuat" href="{{ route('dangXuat') }}">
                <i class="fa fa-sign-out" aria-hidden="true"></i>Đăng xuất
            </a>
        </li>
    </ul>


    <form id="formIDKHThemDiaChi" accept-charset='UTF-8' method='post' action="{{route('khachHang.hoSo.diaChiKH')}}">
        @csrf
        <div class="form-group">
            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
        </div>
    </form>

    <form id="formIDKHLichSuMuaHang" accept-charset='UTF-8' method='post' action="{{route('khachHang.hoSo.diaChiKH')}}">
        @csrf
        <div class="form-group">
            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
        </div>
    </form>

    <form id="formIDKHTatCaDonHang" accept-charset='UTF-8' method='post'
        action="{{route('khachHang.hoSo.danhSachDonHang')}}">
        @csrf
        <div class="form-group">
            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
        </div>
    </form>

    <form id="formIDKHChoXacNhan" accept-charset='UTF-8' class="position-relative form-search" method='post'
        action="{{route('khachHang.hoSo.choXacNhan')}}">
        @csrf
        <div class="form-group">
            <input type="hidden" name="iDSPKHChiTiet" class="form-control"
                value="{{auth()->guard('kh')->user()!=null ? auth()->guard('kh')->user()->kh_ma: 0}}" />
        </div>
    </form>

</div>