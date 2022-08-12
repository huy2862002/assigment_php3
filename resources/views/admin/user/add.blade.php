@extends('layouts.admin.main')
@section('title', 'Tài Khoản')
@section('title_content', 'Tài Khoản')
@section('content')
@if($errors ->any())
<div class="errors">
    <ul class="form">
        @foreach($errors->all() as $error)
        <li style="text-align: left;" class="login-box-msg text-danger">{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{route('admin.user.postAdd')}}" method="post">
    @csrf
    <div class="form">
        <div class="input">
            <b>Họ Và Tên</b>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Họ Và Tên" name="name" value="{{old('name')}}">
            </div>
        </div>
        <div class="input">
            <b>Email</b>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
            </div>
        </div>
        <div class="input">
            <b>Số Điện Thoại</b>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Số Điện Thoại" name="phone_number" value="{{old('phone_number')}}">
            </div>
        </div>
        <div class="input">
            <b>Địa Chỉ</b>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Địa Chỉ" name="address" value="{{old('address')}}">
            </div>
        </div>
    </div>
    <div class="submit">
        <button class="btn btn-success">Thêm Mới</button>
        <button type="reset" class="btn btn-warning">Nhập Lại</button>
    </div>
</form>

@endsection