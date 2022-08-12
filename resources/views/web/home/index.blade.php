@extends('layouts.web.main')
@section('carousel')
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    @for($i=1; $i<=$count; $i++) <li data-target="#header-carousel" data-slide-to="{{$i}}">
                        </li>
                        @endfor
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item position-relative active" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="{{asset($category->avatar)}}" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{$category->name}}</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    @foreach($categories as $c)
                    <div class="carousel-item position-relative relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="{{asset($c->avatar)}}" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{$c->name}}</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="product-offer mb-30" style="height: 200px;">
                <a href="">
                    <img class="img-fluid" src="{{asset('dist/img/ve-sinh.jpg')}}" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Vệ Sinh Phòng</h3>
                    </div>
                </a>
            </div>
            <div class="product-offer mb-30" style="height: 200px;">
                <a href="">
                    <img class="img-fluid" src="{{asset('dist/img/cn.png')}}" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Dịch Vụ Chuyển Nhà</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Chất Lượng Sản Phẩm</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Vận Chuyển Free 3km</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Đổi Lỗi 1 - 1</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Hỗ Trợ 24 / 7</h5>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Bán Chạy</span></h2>
    <div class="row px-xl-5">
        @if(isset($best))
        @foreach($best as $b)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{asset($b->avatar)}}" alt="" width="20%">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <form action="{{route('web.order.postAdd', $b->id)}}" method="post">
                            @csrf
                            <button class="btn btn-outline-dark btn-square"><i class="fa fa-shopping-cart"></i></button>
                        </form>
                        <a class="btn btn-outline-dark btn-square" href="{{route('web.product.detail', $b->id)}}"><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">{{$b->name}}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        @if($b->discount > 0)
                        <h5>đ {{number_format($b->price - ($b->price * $b->discount)/100,0,'.','.')}}</h5>
                        <h6 class="text-muted ml-2"><del>đ {{number_format($b->price,0,'.','.')}}</del></h6>
                        @else
                        <h5>đ {{number_format($b->price,0,'.','.')}}</h5>
                        @endif
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
<!-- Products End -->


<!-- Offer Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="{{asset('dist/img/ve-sinh.jpg')}}" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Vệ Sinh Phòng</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="{{asset('dist/img/cn.png')}}" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Dịch Vụ Chuyển Nhà</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->


<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Phổ Biến</span></h2>
    <div class="row px-xl-5">
        @if(isset($popular))
        @foreach($popular as $p)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{asset($p->avatar)}}" alt="" width="20%">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <form action="{{route('web.order.postAdd', $p->id)}}" method="post">
                            @csrf
                            <button class="btn btn-outline-dark btn-square"><i class="fa fa-shopping-cart"></i></button>
                        </form>
                        <a class="btn btn-outline-dark btn-square" href="{{route('web.product.detail', $p->id)}}"><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        @if($p->discount > 0)
                        <h5>đ {{number_format($p->price - ($p->price * $p->discount)/100,0,'.','.')}}</h5>
                        <h6 class="text-muted ml-2"><del>đ {{number_format($p->price,0,'.','.')}}</del></h6>
                        @else
                        <h5>đ {{number_format($p->price,0,'.','.')}}</h5>
                        @endif
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
<!-- Products End -->
@endsection