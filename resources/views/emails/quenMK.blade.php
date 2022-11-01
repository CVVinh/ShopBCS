<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body>
    <div class="email">
        <div class="email-content">
          <img src="{{asset('avatar/icon.png')}}" alt="" />
<h2>[    Thông Báo Xác Nhận Đổi Mật Khẩu]</h2>

          <h4 class="congra">
            Bạn cần nhấn vào <a href="{{ route('datLaiMatKhau.get', $user) }}">link này</a> để xác nhận việc thay đổi mật khẩu của bạn
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