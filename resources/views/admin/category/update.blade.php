@extends('layouts.admin.main')
@section('title', 'Danh Mục')
@section('title_content', 'Danh Mục')
@section('content')

<form action="{{route('admin.category.putUpdate', $category->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form">
        <div class="input">
            <img src="{{asset($category->avatar)}}" alt="" width="400px" height="280px"><br>
            <b>Tên Danh Mục</b>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Tên Danh Mục" name="name" value="{{isset($category->name) ? $category->name : old('name')}}">
            </div>
            <b>Ảnh Đại Diện</b>
            <div class="input-group mb-3">
                <input type="file" class="form-control"  name="avatar" value="{{isset($category->avatar) ? $category->avatar : old('avatar')}}">
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
        <button class="btn btn-success">Update</button>
    </div>
</form>

@endsection