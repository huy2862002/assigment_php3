@extends('layouts.admin.main')
@section('title', 'Đơn Hàng')
@section('title_content', 'Đơn Hàng')
@section('content')
@if($orders ->all())
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Người Mua</th>
            <th scope="col">Trạng Thái</th>
            <th scope="col">#</th>
            <th scope="col">#</th>
            <th scope="col">#</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $o)
        <tr>
            <td>#PHP{{$o->orderId}}</td>
            <td>{{$o->name}}, {{$o->address}}, {{$o->phone_number}}</td>
            <td>{{config('statusOrder.'.$o->stt)}}</td>
            <td>
               <a href="{{route('admin.order.detail', $o->orderId)}}"><button class="btn btn-info">Chi Tiết</button></a>
            </td>
            @if($o->stt == 1)
            <td>
                <form action ="{{route('admin.order.delivery', $o->orderId)}}" method="post">
                    @csrf
                    @method('put')
                    <button class="btn btn-warning">Giao Hàng</button>
                </form>
            </td>
            @else
            <td>#</td>
            @endif
            @if($o->stt != 3)
            <td>
                <form action ="{{route('admin.order.success', $o->orderId)}}" method="post">
                    @csrf
                    @method('put')
                    <button class="btn btn-success">Hoàn Tất</button>
                </form>
            </td>
            @else
            <td>#</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
<div>
    {{$orders->links()}}
</div>
@else
<div class="fix" style="text-align:center">
    <img width="10%" src="{{asset('dist/img/fix.png')}}" alt=""><br>
    <b class="login-box-msg text-danger">Chưa Có Đơn Hàng Nào !</b><br><br>
</div>
@endif
@endsection