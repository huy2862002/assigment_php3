@extends('layouts.admin.main')
@section('title', 'Ảnh Sản Phẩm')
@section('title_content', 'Ảnh Sản Phẩm')
@section('content')
@if($images ->all())
<div class="image_list" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr ">
    @foreach($images as $i)
    <div class="img" style="margin-bottom:12px">
        <img width="310px" height="310px" src="{{asset($i->image)}}" alt="">
    </div>
    @endforeach
</div>
@else
<div class="fix" style="text-align:center">
    <img width="10%" src="{{asset('dist/img/fix.png')}}" alt=""><br>
    <b class="login-box-msg text-danger">Sản Phẩm {{$product->name}} Chưa Có Ảnh !</b>
</div>
@endif
@endsection