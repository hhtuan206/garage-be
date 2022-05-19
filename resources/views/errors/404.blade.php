@extends('layouts.client')

@section('title', __('Not Found'))
@section('content')
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                <h1 class="display-1">404</h1>
                <h1 class="mb-4">Có lỗi sảy ra</h1>
                <p class="mb-4">Trang bạn tìm kiếm không tồn tại?</p>
                <a class="btn btn-primary rounded-pill py-3 px-5" href="{{route('customer.home')}}">Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</div>
@endsection

