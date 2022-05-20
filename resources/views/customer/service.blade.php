@extends('layouts.client')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Dịch vụ</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Dịch vụ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container-xxl service py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">// Dịch vụ //</h6>
                <h1 class="mb-5">Khám phá dịch vụ của chúng tôi</h1>
            </div>
            <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-8 offset-2">
                    <div class="nav w-100 nav-pills me-4" id="service">
                        @foreach($services as $service)
                            <a class=" nav-link w-100 d-flex align-items-center text-start p-4 mb-4 collapsed"
                               data-toggle="collapse" data-target="#collapse{{$service->id}}" aria-expanded="false"
                               aria-controls="collapse{{$service->id}}"
                               type="button">
                                <i class="fa fa-car-side fa-2x me-3"></i>
                                <h4 class="m-0">{{$service->name}}</h4>
                            </a>
                            <div id="collapse{{$service->id}}" class="collapse" aria-labelledby="headingOne"
                                 data-parent="service">
                                <div class="card-body">
                                    {!! $service->detail !!}
                                </div>
                                <div class="card-footer ">
                                    <label for="" class="text-left">Giá tiền</label>
                                    <label for="" class="justify-content-end"> {{$service->prices}} đ</label>
                                </div>
                            </div>

                        @endforeach
                    </div>

                </div>
                <div class="text-center">{!! $services->links() !!}</div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
