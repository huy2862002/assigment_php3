@extends('layouts.admin.main')
@section('title', 'Danh Mục')
@section('title_content', 'Danh Mục')
@section('content')
@if($categories ->all())
<a href="{{route('admin.category.addForm')}}"><button class="btn btn-info">Thêm Mới</button></a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên Danh Mục</th>
            <th scope="col">Ảnh Đại Diện</th>
            <th scope="col">#</th>
            <th scope="col">#</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $c)
        <tr>
            <td>{{$c->id}}</td>
            <td>{{$c->name}}</td>
            <td><img src="{{asset($c->avatar)}}" alt=""></td>
            <td>
                <form action="{{route('admin.category.delete', $c->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button id="btn-delete" class="btn btn-danger">Xóa</button>
                </form>
            </td>
            <td>
                <a href="{{route('admin.category.updateForm', $c->id)}}"><button class="btn btn-warning">Update</button></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="fix" style="text-align:center">
    <img width="10%" src="{{asset('dist/img/fix.png')}}" alt=""><br>
    <b class="login-box-msg text-danger">Danh Sách Trống !</b><br><br>
    <a href="{{route('admin.category.addForm')}}"><button class="btn btn-info">Thêm Mới</button></a>
</div>
@endif
@endsection