@extends('layouts.admin.main')
@section('title', 'Phân Quyền')
@section('title_content', 'Phân Quyền')
@section('content')

<form action="{{route('admin.role.postAdd')}}" method="post">
    @csrf
    <div class="form">
        <div class="input">
            <b>Tên Phân Quyền</b>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Tên Phân Quyền" name="name" value="{{old('name')}}">
            </div>
        </div>
        @if($errors ->any())
        <div class="errors">
            <ul>
                @foreach($errors->all() as $error)
                <li style="text-align: left;" class="login-box-msg text-danger">{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="submit">
        <button class="btn btn-success">Thêm Mới</button>
        <button type="reset" class="btn btn-warning">Nhập Lại</button>
    </div>
</form>

@endsection