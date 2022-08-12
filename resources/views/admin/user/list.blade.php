@extends('layouts.admin.main')
@section('title', 'Tài Khoản')
@section('title_content', 'Tài Khoản')
@section('content')
@if($users ->all())
<a href="{{route('admin.user.addForm')}}"><button class="btn btn-info">Thêm Mới Amin</button></a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Họ Và Tên</th>
            <th scope="col">Ảnh Đại Diện</th>
            <th scope="col">Email</th>
            <th scope="col">Số Điện Thoại</th>
            <th scope="col">Địa Chỉ</th>
            <th scope="col">Phân Quyền</th>
            <th scope="col">Trạng Thái</th>
            <th scope="col">#</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $u)
        <tr>
            <td>{{$u->id}}</td>
            <td>{{$u->name}}</td>
            <td><img width="31px" src="{{asset($u->avatar)}}" alt=""></td>
            <td>{{$u->email}}</td>
            <td>{{$u->phone_number}}</td>
            <td>{{$u->address}}</td>
            <td>{{$u->roleName}}</td>
            <td>
                <form action="{{route('admin.user.changeStatus', $u->id)}}" method="post">
                    @csrf
                    @method('put')
                    <button class="{{$u->status == 0 ? 'btn btn-danger' : 'btn btn-success'}}">{{$u->status == 0 ? 'Bị Khóa' : 'Hoạt Động'}}</button>
                </form>
            </td>
            <td>
                <form action="{{route('admin.user.delete', $u->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button id="btn-delete" class="btn btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="fix" style="text-align:center">
    <img width="10%" src="{{asset('dist/img/fix.png')}}" alt=""><br>
    <b class="login-box-msg text-danger">Danh Sách Trống !</b><br><br>
    <a href="{{route('admin.user.addForm')}}"><button class="btn btn-info">Thêm Mới</button></a>
</div>
@endif
@endsection