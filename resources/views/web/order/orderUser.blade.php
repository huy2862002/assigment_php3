@extends('layouts.web.main')
@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{route('home')}}">Home</a>
                <span class="breadcrumb-item active">Đơn Hàng</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Order Start -->
@if($order->all())
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã Đơn Hàng</th>
                        <th>Trạng Thái</th>
                        <th>#</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach($order as $o)
                    <tr>
                        <td class="align-middle">#PHP{{$o->id}}</td>
                        <td class="align-middle">{{config('statusOrder.'.$o->status)}}</td>
                        <td class="align-middle">
                            <a href="{{route('web.order.detail_u', $o->id)}}"><button class="btn btn-info">Chi Tiết</button></a>
                        </td>
                        <td class="align-middle">
                             @if($o->status == 1)
                            <form action="{{route('web.order.destroy', $o->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button id="btn-delete" class="btn btn-danger">Hủy</button>
                            </form>
                            
                            @endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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