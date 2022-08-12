<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo</title>
</head>

<body>
    <div class="container">
        <h3>Xin Chào {{$data['name']}} !</h3>
        <b>Mã Xác Nhận Của Bạn Là : {{$data['code']}}</b>
    </div>
</body>

</html>