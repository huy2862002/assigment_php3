@extends('layouts.web.main')
@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Trang chủ</a>
                <a class="breadcrumb-item text-dark" href="#">Cart</a>
                <span class="breadcrumb-item active">Thanh Toán</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

@if($cart->all())
<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Địa Chỉ Nhận Hàng</span></h5>
            <div class="bg-light p-30 mb-5">
                <form action="{{route('web.auth.updateUser')}}" method="post">
                    @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Họ Và Tên</label>
                        <input class="form-control" name="name" type="text" value="{{Auth::user()->name}}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" type="text" value="{{Auth::user()->email}}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Số Điện Thoại</label>
                        <input class="form-control" name="phone_number" type="text" value="{{Auth::user()->phone_number}}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Địa Chỉ</label>
                        <input class="form-control" name="address" type="text" value="{{Auth::user()->address}}">
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-warning">Cập Nhật Địa Chỉ</button>
                    </div>
                    </form>
                </div>
            </div>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Chuyển Khoản</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Ngân Hàng : </label>
                        <span>MB Bank</span>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Số Tài Khoản : </label>
                        <span>99888828062002</span>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Chủ Tài Khoản : </label>
                        <span>Nguyễn Quang Huy</span>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Nội Dung Chuyển Khoản : </label>
                        <span>PAYMENTPH{{$code}}</span>
                    </div>
                </div>
            </div>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Ví MoMo</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Ví MoMo</label>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Số Tài Khoản : </label>
                        <span>0123456789</span>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Chủ Tài Khoản : </label>
                        <span>Nguyễn Quang Huy</span>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Nội Dung Chuyển Khoản : </label>
                        <span>PAYMENTPH{{$code}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Chi Tiết Đơn Hàng</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom">
                    <h6 class="mb-3">Sản Phẩm</h6>
                    @foreach($cart as $c)
                    <div class="d-flex justify-content-between">
                        <p>{{$c->name}} ( {{$c->quantity}} )</p>
                        <p>đ {{number_format($c->total_money,0,'.','.')}}</p>
                    </div>
                    @endforeach
                </div>
                <div class="border-bottom pt-3 pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Tổng Tiền Hàng</h6>
                        <h6>đ {{number_format($total,0,'.','.')}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Phí Vận Chuyển ( 2,8 km )</h6>
                        <h6 class="font-weight-medium">đ {{$ship}}</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Thành Tiền</h5>
                        <h5>đ {{number_format($total + $ship,0,'.','.')}}</h5>
                    </div>
                </div>
                <form action="{{route('web.order.handle', $code)}}" method="post">
                    @csrf
                    @method('put')
                    <button style="margin-top: 200px" class="btn btn-block btn-primary font-weight-bold py-3">Đặt Hàng</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Checkout End -->
@endif
@endsection