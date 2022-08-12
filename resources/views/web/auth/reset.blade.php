<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
            max-width: 500px;
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
            @if(session()->has('error_reset'))
            <li class="login-box-msg text-danger"> {{session()->get('error_reset')}}</li>
            @endif
            <form method="POST" action="{{route('web.auth.postReset')}}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"><b>Nhập Mật Khẩu Mới</b></label>
                    <input type="password" name="password" class="form-control" placeholder="Mật Khẩu" value="{{old('password')}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"><b>Nhập Lại</b></label>
                    <input type="password" name="re_password" class="form-control" placeholder="Nhập Lại Mật Khẩu" value="{{old('re_password')}}">
                </div>
                <button type="submit" class="btn btn-success">Xác Nhận</button><br><br>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>