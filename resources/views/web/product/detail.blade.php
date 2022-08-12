@extends('layouts.web.main')
@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Trang Chủ</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Chi Tiết Sản Phẩm</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{asset($product->avatar)}}" alt="Image">
                    </div>
                    @if($images ->all())
                    @foreach($images as $i)
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="{{asset($i->image)}}" alt="Image">
                    </div>
                    @endforeach
                    @endif
                </div>
                @if($images ->all())
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
                @endif
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{$product->name}}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(99 Reviews)</small>
                </div>
                @if($product->discount > 0)
                <h3 class="font-weight-semi-bold mb-4">đ {{number_format($product->price - ($product->price * $product->discount)/100,0,'.','.')}}</h3>
                <h5 class="text-muted ml-2"><del>đ {{number_format($product->price,0,'.','.')}}</del></h5>
                @else
                <h3 class="font-weight-semi-bold mb-4">đ {{number_format($product->price,0,'.','.')}}</h3>
                @endif

                <p class="mb-4">Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam stet sit
                    clita ea. Sanc ipsum et, labore clita lorem magna duo dolor no sea
                    Nonumy</p>
                <div class="d-flex mb-3">
                    <strong class="text-dark mr-3">Kích Thước : </strong>{{$product->size}}
                </div>
                <div class="d-flex mb-4">
                    <strong class="text-dark mr-3">Chất Liệu : </strong>{{$product->insurance}}
                </div>
                <form action="{{route('web.order.postAdd', $product->id)}}" method="post">
                    @csrf
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1" name="quantity">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>

                    </div>
                </form>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Mô Tả</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Thông Tin Thêm</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Đánh Giá</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">{{$product->name}}</h4>
                        <p>{{$product->description}}</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <!-- <h4 class="mb-3">Additional Information</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                            </div> -->
                    </div>

                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            @if($comment_product ->all())
                            <div class="col-md-6">
                                <h4 class="mb-4">@if($count_comment > 0 ) {{$count_comment}} @endif đánh giá cho "{{$product->name}}"</h4>
                                @foreach($comment_product as $cm)
                                <div class="media mb-4">
                                    <img src="{{asset($cm->avatar)}}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6><small> {{$cm->userName}} <i>{{$cm->date_comment}}</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>{{$cm->content}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            @if($order_user->all() && $comment_exist == false)
                            <div class="col-md-6">
                                <h4 class="mb-4">Đánh Giá Sản Phẩm</h4>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Hài Lòng * :</p>
                                    <div class="text-primary">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <form action="{{route('web.comment.postAdd', $product->id)}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="message">Đánh Giá</label>
                                        <textarea name="content" id="message" cols="30" rows="5" class="form-control">{{old('content')}}</textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Gửi Đánh Giá" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->

@if($similar ->all())
<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h3 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản Phẩm Tương Tự</span></h3>
    <div class="row px-xl-5">
        @foreach($similar as $s)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{asset($s->avatar)}}" alt="" width="20%">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <form action="{{route('web.order.postAdd', $s->id)}}" method="post">
                            @csrf
                            <button class="btn btn-outline-dark btn-square"><i class="fa fa-shopping-cart"></i></button>
                        </form>
                        <a class="btn btn-outline-dark btn-square" href="{{route('web.product.detail', $s->id)}}"><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">{{$s->name}}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        @if($s->discount > 0)
                        <h5>đ {{number_format($s->price - ($s->price * $s->discount)/100,0,'.','.')}}</h5>
                        <h6 class="text-muted ml-2"><del>đ {{number_format($s->price,0,'.','.')}}</del></h6>
                        @else
                        <h5>đ {{number_format($s->price,0,'.','.')}}</h5>
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
    </div>
</div>
<!-- Products End -->
@endif
@endsection