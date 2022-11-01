@extends('boCuc')

@section('noiDung')
@include('menu')

@include('sanpham.flashSale')

<div class="ads my-4">
    <div class="container">
        <img src="{{asset('uploads/'.$quangCaoMiddle->hinhqcs[0]->hqc_ten)}}" alt="">
    </div>
</div>

@include('sanpham.danhMucPhoBien')

@include('sanpham.sanPhamThuongHieu')

<section id="order">
    <div class="container">
        <img src="{{asset('uploads/'.$quangCaoFooter->hinhqcs[0]->hqc_ten)}}" alt="">
    </div>
</section>
@endsection