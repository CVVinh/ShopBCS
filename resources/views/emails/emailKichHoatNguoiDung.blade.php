<html>

<head>
    <title>Activation Email - Allaravel.com</title>
</head>

<body>
    <div class="email">
        <div class="email-content">
          <img src="{{asset('avatar/icon.png')}}" alt="" />
          <h2>[Thông Báo Xác Nhận Mật Khẩu]</h2>
          <h4 class="congra">
            Chào mừng {{ $user->ten }} đã đăng ký thành viên tại shopbcs. Bạn hãy
            click vào đường <a href="{{ $user->lienketkichhoat }}">link này</a> để
            hoàn tất việc đăng ký.
          </h4>
          <h4>
            Mã xác nhận hết hạn sau 2 phút! Bạn vui lòng đăng nhập lại để lấy mã
            xác nhận.
          </h4>
  
          <div class="email-thank">
            <p>Cảm ơn!</p>
            <p>PlayBoy</p>
          </div>
        </div>
      </div>

</body>

</html>