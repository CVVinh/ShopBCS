@extends('boCuc')

@section('lienKet-CSS-DauTrang')
<link rel="stylesheet" href="{{ asset('css/taiKhoan.css') }}" />
@endsection

@section('lienKet-JS-DauTrang')
<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>
@endsection

@section('noiDung')
<section class="card-login py-4">
    <div class="container mb-4">
   
	<div class="row">
		<div class="col-md-6 form-center">
			@include('xacthuc.dangNhap')
			@include('xacthuc.quenMK')
		</div>
	</div>

</div>
</section>
@endsection

@section('lienKet-JS-CuoiTrang')
<script src="{{ asset('js/auth/dangNhap.js') }}"></script>
<script src="{{ asset('js/auth/dangKy.js') }}"></script>

<script src="{{ asset('js/auth/formDoiMKEmail.js') }}"></script>
<script src="{{ asset('js/auth/formDoiMKNhapSDT.js') }}"></script>
<script src="{{ asset('js/auth/formDoiMatKhauSDT.js') }}"></script>
<script src="{{ asset('js/auth/formXacThucMaSDT.js') }}"></script>

@endsection
