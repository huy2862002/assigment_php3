@extends('layouts.admin.main')
@section('title', 'Sản Phẩm')
@section('title_content', 'Sản Phẩm')
@section('content')
@if($products ->all())
<a href="{{route('admin.product.addForm')}}"><button class="btn btn-info">Thêm Mới</button></a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên Sản Phẩm</th>
            <th scope="col">Ảnh Đại Diện</th>
            <th scope="col">Danh Mục</th>
            <th scope="col">Giá ( đ )</th>
            <th scope="col">% Giảm</th>
            <th scope="col">Mô Tả</th>
            <th scope="col">Trạng Thái</th>
            <th scope="col">#</th>
            <th scope="col">#</th>
            <th scope="col">#</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->name}}</td>
            <td><img src="{{asset($p->avatar)}}" alt=""></td>
            <td>{{$p->cateName}}</td>
            <td>{{number_format($p->price, 0, '.', '.')}}</td>
            <td>{{$p->discount}}</td>
            <td>{{$p->description}}</td>
            <td>
                <form action="{{route('admin.product.changeStatus', $p->id)}}" method="post">
                    @csrf
                    @method('put')
                    <button class="{{$p->status == 0 ? 'btn btn-danger' : 'btn btn-success'}}">{{$p->status == 0 ? 'HH' : 'CH'}}</button>
                </form>
            </td>
            <td>
                <form action="{{route('admin.product.delete', $p->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button id="btn-delete" class="btn btn-danger">Xóa</button>
                </form>
            </td>
            <td>
                <a href="{{route('admin.product.image', $p->id)}}"><button class="btn btn-info">Ảnh</button></a>
            </td>
            <td>
                <a href="{{route('admin.product.updateForm', $p->id)}}"><button class="btn btn-warning">Update</button></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div>
    {{$products->links()}}
</div>
@else
<div class="fix" style="text-align:center">
    <img width="10%" src="{{asset('dist/img/fix.png')}}" alt=""><br>
    <b class="login-box-msg text-danger">Danh Sách Trống !</b><br><br>
    <a href="{{route('admin.product.addForm')}}"><button class="btn btn-info">Thêm Mới</button></a>
</div>
@endif
@endsection