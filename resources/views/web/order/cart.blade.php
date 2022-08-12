@extends('layouts.web.main')
@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{route('home')}}">Home</a>
                <span class="breadcrumb-item active">Giỏ Hàng</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
@if($cart->all())
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Sản Phẩm</th>
                        <th>Đơn Giá</th>
                        <th>Số Lượng</th>
                        <th>Tổng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach($cart as $c)
                    <tr>
                        <td class="align-middle"><img src="{{asset($c->avatar)}}" alt="" style="width: 50px;">{{$c->name}}</td>
                        <td class="align-middle">đ {{number_format($c->price - ($c->price * $c->discount /100),0,'.','.')}}</td>
                        <td class="align-middle">
                            <form action="{{route('web.order.change', $c->detailId)}}" method="post">
                                @csrf
                                @method('put')
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$c->quantity}}" name="quantity">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td class="align-middle">đ {{number_format($c->total_money,0,'.','.')}}</td>
                        <td class="align-middle">
                            <form action="{{route('web.order.delete', $c->detailId)}}" method="post">
                                @csrf
                                @method('delete')
                                <button id="btn-delete" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-30" action="">
                <div class="input-group">
                    <input type="text" class="form-control border-0 p-4" placeholder="Mã Giảm Giá">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Mã Giảm Giá</button>
                    </div>
                </div>
            </form>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Thanh Toán</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
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
                        <h5>đ {{number_format($total + $ship, 0, '.', '.')}}</h5>
                    </div>
                    <a href="{{route('web.order.pay')}}"><button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Thanh Toán</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@else
<div class="fix" style="text-align:center">
    <b class="login-box-msg text-danger">Giỏ Hàng Trống !</b><br><br>
</div>
@endif
@endsection