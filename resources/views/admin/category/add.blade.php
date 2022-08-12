@extends('layouts.admin.main')
@section('title', 'Danh Mục')
@section('title_content', 'Danh Mục')
@section('content')

<form action="{{route('admin.category.postAdd')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form">
        <div class="input">
            <b>Tên Danh Mục</b>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Tên Danh Mục" name="name" value="{{old('name')}}">
            </div>
            <b>Ảnh Đại Diện</b>
            <div class="input-group mb-3">
                <input type="file" class="form-control"  name="avatar" value="{{old('avatar')}}">
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