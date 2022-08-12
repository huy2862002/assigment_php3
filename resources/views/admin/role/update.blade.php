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
<form action="{{route('admin.product.postAdd')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form">
        <div class="input">
            <b>Tên Sản Phẩm ( * )</b>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Tên Sản Phẩm" name="name" value="{{old('name')}}">
            </div>
        </div>
        <div class="input">
            <b>Giá Sản Phẩm ( * )</b>
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Giá Sản Phẩm" name="price" value="{{old('price') ? old('price') : 0}}">
            </div>
        </div>
        <div class="input">
            <b>Mức Giảm Giá</b>
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Mức Giảm Giá" name="discount" value="{{old('discount') ? old('discount') : 0}}">
            </div>
        </div>
        <div class="input">
            <b>Chất Liệu ( * )</b>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Chất Liệu" name="insurance" value="{{old('insurance') ? old('insurance') : 'N/A'}}">
            </div>
        </div>
        <div class="input">
            <b>Kích Thước ( * )</b>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Kích Thước" name="size" value="{{old('size') ? old('size') : 'N/A'}}">
            </div>
        </div>
        <div class="input">
            <b>Trạng Thái</b>
            <select class="form-control" name="status">
                <option value="{{old('status') == 0 ? 0 : 1}}">{{old('status') == 0 ? 'Hết Hàng' : 'Còn Hàng'}}</option>
                <option value="{{old('status') == 0 ? 1 : 0}}">{{old('status') == 0 ? 'Còn Hàng' : 'Hết Hàng'}}</option>
            </select>
        </div>
        <div class="input">
            <b>Danh Mục ( * )</b>
            <select class="form-control" name="category_id">
                <option disabled selected>Chọn Danh Mục</option>
                @foreach($categories as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="input">
            <b>Mô Tả</b>
            <div class="form-group">
                <textarea name="description" class="form-control" rows="3" placeholder="Mô Tả ..."></textarea>
            </div>
        </div>

    </div>
    <div class="submit">
        <button class="btn btn-success">Thêm Mới</button>
        <button type="reset" class="btn btn-warning">Nhập Lại</button>
    </div>
</form>

@endsection