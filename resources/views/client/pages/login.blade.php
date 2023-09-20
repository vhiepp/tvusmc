<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Đăng nhập | TVU Social Media Club</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>
  
    <div class="form-container">
        <div class="btn-back" title="Trở lại">
            <a href="/">
                <i class='bx bx-left-arrow-alt'></i>
            </a>
        </div>
        <div class="form-title">
            <span>Đăng nhập</span>
        </div>

        <div method="post">
            <div class="form-item">
                <input type="text" name="email" id="email" placeholder=" " value="@if (\Session::has('email')){{ Session::get('email') }}
            @endif" required>
                <label for="email" class="form-item__label">Email</label>
            </div>
            <div class="form-item">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password" class="form-item__label">Mật khẩu</label>
            </div>
            <button class="btn-submit no-loader">Đăng nhập</button>
            @csrf
        </div>
        <div class="rigister">
            <p>
                <span>Bạn chưa có tài khoản? </span>
                <a class="no-loader">
                    <span>Đăng ký</span>
                </a>
            </p>
        </div>
        @if (\Session::has('error_code'))
             <small style="color: red; text-align: center; display: block;"><i>{{Session::get('error_code')}}</i></small>
        @endif
        <a href="{{ route('auth.login.microsoft') }}" class="login-with">
            <img src="/assets/img/logo/microsoft.png" >
            <span>Đăng nhập với microsoft</span>
        </a>

        <a href="{{ route('auth.login.google') }}" class="login-with">
            <img src="/assets/img/logo/google.png" >
            <span>Đăng nhập với google</span>
        </a>
    </div>
</body>
</html>
