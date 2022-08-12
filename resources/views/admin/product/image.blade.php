@extends('layouts.admin.main')
@section('title', 'Ảnh Sản Phẩm')
@section('title_content', 'Ảnh Sản Phẩm')
@section('content')
@if($images ->all())
<b style="color: red;">Tên Sản Phẩm : {{$product->name}}</b> <br>
<a href="{{route('admin.image.addForm', $product->id)}}"><button class="btn btn-info">Thêm Ảnh</button></a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Ảnh Sản Phẩm</th>
            <th scope="col">#</th>
            <th scope="col">#</th>
        </tr>
    </thead>
    <tbody>
        @foreach($images as $i)
        <tr>
            <td>{{$i->id}}</td>
            <td><img src="{{asset($i->image)}}" alt=""></td>
            <td>
                <form action="{{route('admin.image.delete', $i->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button id="btn-delete" class="btn btn-danger">Xóa</button>
                </form>
            </td>
            <td>
                <a href="{{route('admin.image.updateForm', $i->id)}}"><button class="btn btn-warning">Update</button></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="fix" style="text-align:center">
    <img width="10%" src="{{asset('dist/img/fix.png')}}" alt=""><br>
    <b class="login-box-msg text-danger">Sản Phẩm {{$product->name}} Chưa Có Ảnh !</b><br><br>
    <a href="{{route('admin.image.addForm', $product->id)}}"><button class="btn btn-info">Thêm Ảnh</button></a>
</div>
@endif
@endsection