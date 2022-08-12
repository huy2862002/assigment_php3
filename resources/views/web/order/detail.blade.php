@extends('layouts.web.main')
@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{route('home')}}">Home</a>
                <a class="breadcrumb-item text-dark" href="">Đơn Hàng</a>
                <span class="breadcrumb-item active">Chi Tiết</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Order Start -->
@if($details->all())
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Sản Phẩm</th>
                        <th>Đơn Giá</th>
                        <th>Số Lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach($details as $d)
                    <tr>
                        <td class="align-middle">
                            <img width="66px" src="{{asset($d->avatar)}}" alt="">
                            {{$d->name}}
                        </td>
                        <td class="align-middle">đ {{number_format($d->price - ($d->price * $d->discount /100), 0, '.', '.')}}</td>
                        <td class="align-middle">{{$d->quantity}}</td>
                        <td class="align-middle">đ {{number_format($d->total_money, 0, '.', '.')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <b>Thành Tiền : đ {{number_format($total,0,'.','.')}}</b>
        </div>
    </div>
</div>
<!-- Order End -->
@else
<div class="fix" style="text-align:center">
    <b class="login-box-msg text-danger">Bạn Chưa Có Đơn Hàng Nào !</b><br><br>
</div>
@endif
@endsection