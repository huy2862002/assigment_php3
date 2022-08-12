@extends('layouts.admin.main')
@section('title', 'Đơn Hàng')
@section('title_content', 'Đơn Hàng')
@section('content')
@if($details ->all())
<table class="table">
    <thead>
        <tr>
            <th scope="col">Sản Phẩm</th>
            <th scope="col">Đơn Giá</th>
            <th scope="col">Số Lượng</th>
            <th scope="col">Tổng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($details as $d)
        <tr>
            <td>
                <img width="9px" src="{{asset($d->avatar)}}" alt="">
                {{$d->name}}
            </td>
            <td>đ {{number_format($d->price - ($d->discount * $d->price /100),0,'.','.')}}</td>
            <td>{{$d->quantity}}</td>
            <td>đ {{number_format($d->total_money,0,'.','.')}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<b>Thành Tiền : đ {{number_format($total,0,'.','.')}}</b>
@endif
@endsection