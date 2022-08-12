@extends('layouts.admin.main')
@section('title', 'Ảnh Sản Phẩm')
@section('title_content', 'Ảnh Sản Phẩm')
@section('content')
<img src="{{asset($img->image)}}" alt="" width="400px" height="280px">
<form action="{{route('admin.image.putUpdate', $img->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form">
        <div class="input">
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="image">
            </div>
        </div>
    </div>
    <div class="submit">
        <button class="btn btn-success">Update</button>
    </div>
</form>

@endsection