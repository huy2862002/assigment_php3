<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('dist/css/admin.css')}}">
    <!--  css admin -->
    <style>
        body {
            max-width: 100%;
            margin: 0 auto;
        }

        .container {
            max-width: 1080px;
            margin: 0 auto;
        }

        .login {
            max-width: 1080px;
            margin: 100px auto;
            padding: 50px;
            border: 1px solid #ca49f4;
            border-radius: 12px;
            background-color: #FFD333 !important;
            border: 2px solid orangered;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login">
            <div class="logo" style="text-align:center; margin-bottom:12px">
                <a href="{{route('home')}}"><img width="120px" src="{{asset('dist/img/logo.png')}}" alt=""></a>
            </div>
            @if($errors ->any())
            <ul>
                @foreach($errors->all() as $error)
                <li class="login-box-msg text-danger">{{$error}}</li>
                @endforeach
            </ul>
            @endif
            @if(session()->has('exist'))
            <li class="login-box-msg text-danger"> {{session()->get('exist')}}</li>
            @endif
            <form action="{{route('web.auth.postRegister')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form">
                    <div class="input">
                        <b>Họ Và Tên ( * )</b>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Họ Và Tên" name="name" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="input">
                        <b>Email ( * )</b>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                        </div>
                    </div>
                    <div class="input">
                        <b>Số Điện Thoại ( * )</b>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Số Điện Thoại" name="phone_number" value="{{old('phone_number')}}">
                        </div>
                    </div>
                    <div class="input">
                        <b>Địa Chỉ ( * )</b>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Địa Chỉ" name="address" value="{{old('address')}}">
                        </div>
                    </div>
                    <div class="input">
                        <b>Mật Khẩu ( * )</b>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Mật Khẩu" name="password" value="{{old('password')}}">
                        </div>
                    </div>
                    <div class="input">
                        <b>Ảnh Đại Diện</b>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="avatar">
                        </div>
                    </div>
                </div>
                <div class="submit" style="display: flex; justify-content:space-between">
                    <button type="submit" class="btn btn-success">Đăng Ký</button>
                    <a style="text-decoration:none; color: green" href="{{route('web.auth.loginForm')}}">Bạn Đã Có Tài Khoản ?</a>
                </div>
            </form>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>