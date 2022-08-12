@extends('layouts.web.main')
@section('content')

@if(Auth::check())
<div class="container-fluid">
    <div class="row px-xl-5">
        <form action="{{route('web.auth.update_u')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-12" style="display:grid; grid-template-columns:333px 1fr 1fr; grid-gap:66px">
            <div class="avatar"><img width="333px" height="333px" src="{{asset(Auth::user()->avatar)}}" alt="">
            <input type="file" class="form-control" name="avatar"></div>
            <div class="info">
                <b>ID : USERPH{{Auth::user()->id}}</b><br><br>
                <b>Email : {{Auth::user()->email}}</b><br><br>
                <b>Địa Chỉ : {{Auth::user()->address}}</b><br><br>
                <b>Số Điện Thoại : {{Auth::user()->phone_number}}</b><br><br>
            </div>
            <div class="change">
            @if(session()->has('error_update'))
            <li class="login-box-msg text-danger"> {{session()->get('error_update')}}</li>
            @endif
                <b>ID : USERPH{{Auth::user()->id}}</b><br><br>
            <input type="text" class="form-control" value="{{Auth::user()->email}}" name="email"><br>
            <input type="text" class="form-control" value="{{Auth::user()->address}}" name="address"><br>
            <input type="text" class="form-control" value="{{Auth::user()->phone_number}}" name="phone_number"><br>
            </div>
            <button class="btn btn-info">Cập Nhật Tài Khoản</button>
        </div>
        </form>
       
    </div>
</div>
@endif

@endsection