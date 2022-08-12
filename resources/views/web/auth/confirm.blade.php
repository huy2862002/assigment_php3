<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Thực Tài Khoản</title>
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
            @if(session()->has('error_confirm'))
            <li class="login-box-msg text-danger"> {{session()->get('error_confirm')}}</li>
            @endif
            <form method="POST" action="{{route('web.auth.postConfirm')}}">
                @csrf
                <div class="mb-3">
                    <label class="form-label"><b>Nhập Mã Xác Thực</b></label>
                    <input type="text" name="confirm" class="form-control" placeholder="confirm" value="{{old('confirm')}}">
                </div>
                <button type="submit" class="btn btn-success">Xác Nhận</button><br><br>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>