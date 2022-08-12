@extends('layouts.admin.main')
@section('title', 'Phân Quyền')
@section('title_content', 'Phân Quyền')
@section('content')
@if($roles ->all())
<a href="{{route('admin.role.addForm')}}"><button class="btn btn-info">Thêm Mới</button></a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên Phân Quyền</th>
            <th scope="col">#</th>
            <th scope="col">#</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $r)
        <tr>
            <td>{{$r->id}}</td>
            <td>{{$r->name}}</td>
            <td>
                <form action="{{route('admin.role.delete', $r->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button id="btn-delete" class="btn btn-danger">Xóa</button>
                </form>
            </td>
            <td>
                <a href="{{route('admin.role.updateForm', $r->id)}}"><button class="btn btn-warning">Update</button></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="fix" style="text-align:center">
    <img width="10%" src="{{asset('dist/img/fix.png')}}" alt=""><br>
    <b class="login-box-msg text-danger">Danh Sách Trống !</b><br><br>
    <a href="{{route('admin.role.addForm')}}"><button class="btn btn-info">Thêm Mới</button></a>
</div>
@endif
@endsection