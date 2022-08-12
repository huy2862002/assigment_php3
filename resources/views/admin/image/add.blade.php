@extends('layouts.admin.main')
@section('title', 'Ảnh Sản Phẩm')
@section('title_content', 'Ảnh Sản Phẩm')
@section('content')

<form action="{{route('admin.image.postAdd', $product->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form">
        <div class="input">
            <b style="color: red;">Thêm Ảnh Cho Sản Phẩm : {{$product->name}}</b>
            <div class="input-group mb-3">
                <input required type="file" class="form-control"  name="image" value="{{old('image')}}">
            </div>
        </div>
    </div>
    <div class="submit">
        <button class="btn btn-success">Thêm Ảnh</button>
    </div>
</form>

@endsection