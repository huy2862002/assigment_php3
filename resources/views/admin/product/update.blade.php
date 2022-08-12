@extends('layouts.admin.main')
@section('title', 'Sản Phẩm')
@section('title_content', 'Sản Phẩm')
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
<form action="{{route('admin.product.putUpdate', $product->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <img src="{{asset($product->avatar)}}" alt="" width="400px" height="250px"><br>
    <div class="form">
        <div class="input">
            <b>Tên Sản Phẩm ( * )</b>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Tên Sản Phẩm" name="name" value="{{$product->name ? $product->name : old('name')}}">
            </div>
        </div>
        <div class="input">
            <b>Ảnh Đại Diện</b>
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="avatar">
            </div>
        </div>
        <div class="input">
            <b>Giá Sản Phẩm ( * )</b>
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Giá Sản Phẩm" name="price" value="{{$product->price ? $product->price : old('price')}}">
            </div>
        </div>
        <div class="input">
            <b>Mức Giảm Giá</b>
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Mức Giảm Giá" name="discount" value="{{$product->discount ? $product->discount : old('discount')}}">
            </div>
        </div>
        <div class="input">
            <b>Chất Liệu ( * )</b>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Chất Liệu" name="insurance" value="{{$product->insurance ? $product->insurance : old('insurance')}}">
            </div>
        </div>
        <div class="input">
            <b>Kích Thước ( * )</b>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Kích Thước" name="size" value="{{$product->size ? $product->size : old('size')}}">
            </div>
        </div>
        <div class="input">
            <b>Trạng Thái</b>
            <select class="form-control" name="status">
                <option value="{{$product->status == 0 ? 0 : 1}}">{{$product->status == 0 ? 'Hết Hàng' : 'Còn Hàng'}}</option>
                <option value="{{$product->status == 0 ? 1 : 0}}">{{$product->status == 0 ? 'Còn Hàng' : 'Hết Hàng'}}</option>
            </select>
        </div>
        <div class="input">
            <b>Danh Mục ( * )</b>
            <select class="form-control" name="category_id">
                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                @foreach($categories as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="input">
            <b>Mô Tả</b>
            <div class="form-group">
                <textarea name="description" class="form-control" rows="3" placeholder="Mô Tả ...">{{$product->description}}</textarea>
            </div>
        </div>
    </div>
    <div class="submit">
        <button class="btn btn-success">Update</button>
    </div>
</form>

@endsection