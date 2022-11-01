<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}">
    
    <!-- Page Title  -->
    <title>Inhoadon</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('/assets/css/dashlite.css?ver=2.5.0')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('/assets/css/theme.css?ver=2.5.0')}}">

</head>
<style>
    th,td{
        height: 30px;
        border: 1px solid black; 
        text-align: center;
        font-family:Arial, Helvetica, sans-serif;
    }
    td{
        text-align: center;
    }

    .thtd{
        border: none; 
    }
    .thtd1{
        border: none; 
        text-align: start;
    }
</style>
<body class="bg-white" onload="printPromot()">

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview wide-md mx-auto">
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-head nk-block-head">
                                <div class="nk-block-head-content d-flex justify-content-center flex-column align-items-center">
                                    <h4 class="nk-block-title">Chi tiết hóa đơn - MS {{$hoadon->hd_ma}}</h4>
                                    <h6 class="nk-block-title">Nhân viên TT: {{$hoadon->nhanvien!=null ? $hoadon->nhanvien->ten : "Chưa rõ"}}</h6>
                                    <h6 class="nk-block-title">Nhân viên TT: {{$hoadon->khachhang!=null ? $hoadon->khachhang->ten : "Chưa rõ"}}</h6>
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
    <script>
        function printPromot() {
            window.print();
        }
    </script>
</body>


