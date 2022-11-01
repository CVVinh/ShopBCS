@extends('admin.master')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title">Chi tiết hóa đơn - MS {{$hoadon->hd_ma}}</h4>
                                <h6 class="nk-block-title">Nhân viên TT: {{$hoadon->nhanvien!=null ? $hoadon->nhanvien->ten : "Chưa rõ"}}</h6>
                                <h6 class="nk-block-title">Nhân viên TT: {{$hoadon->khachhang!=null ? $hoadon->khachhang->ten : "Chưa rõ"}}</h6>
                                <a href="{{route('admin.hoadon.inhoadon',['id'=>$hoadon->hd_ma])}}" target="_blank" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-printer-fill"></em><span>In</span></a>
                            </div>
                        </div>
                        <div class="card card-preview">
                            <div class="card-inner">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">MASP</th>
                                            <th scope="col">Tên SP</th>
                                            <th scope="col">Đơn vị</th>
                                            <th scope="col">Giá bán</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($hoadon->sanphams as $sanpham)
                                        <tr>
                                            <th scope="row">{{$sanpham->sp_ma}}</th>
                                            <td>{{$sanpham->sp_ten}}</td>
                                            <td>{{$sanpham->pivot->donvi->dv_ten}}</td>
                                            <td>{{$sanpham->pivot->giaban}}</td>
                                            <td>{{$sanpham->pivot->soluong}}</td>
                                            <td>{{$sanpham->pivot->thanhtien}}</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <th colspan="5" style="text-align:right">Tổng tiền</th>
                                            <th>{{$hoadon->hd_tongtien}}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection