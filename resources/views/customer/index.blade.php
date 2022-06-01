@extends('layouts.client')
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{asset('clients')}}/img/carousel-bg-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown"></h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Trung tâm sửa
                                        chữa {{config('app.name')}}</h1>
                                    <a href="{{route('customer.appointment')}}"
                                       class="btn btn-primary py-3 px-5 animated slideInDown">Đặt lịch ngay<i
                                            class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="{{asset('clients')}}/img/carousel-1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--                <div class="carousel-item">--}}
                {{--                    <img class="w-100" src="{{asset('clients')}}/img/carousel-bg-2.jpg" alt="Image">--}}
                {{--                    <div class="carousel-caption d-flex align-items-center">--}}
                {{--                        <div class="container">--}}
                {{--                            <div class="row align-items-center justify-content-center justify-content-lg-start">--}}
                {{--                                <div class="col-10 col-lg-7 text-center text-lg-start">--}}
                {{--                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">// Car Servicing--}}
                {{--                                        //</h6>--}}
                {{--                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Qualified Car Wash--}}
                {{--                                        Service Center</h1>--}}
                {{--                                    <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">Learn More<i--}}
                {{--                                            class="fa fa-arrow-right ms-3"></i></a>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">--}}
                {{--                                    <img class="img-fluid" src="{{asset('clients')}}/img/carousel-2.png" alt="">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Fact Start -->
    <div class="container-fluid fact bg-dark my-5 py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <i class="fa fa-check fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">{{count($services)}}</h2>
                    <p class="text-white mb-0">Dịch vụ</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <i class="fa fa-users-cog fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">{{count($users)}}</h2>
                    <p class="text-white mb-0">Nhân viên</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <i class="fa fa-users fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">{{count($components)}}</h2>
                    <p class="text-white mb-0">Linh kiện</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <i class="fa fa-car fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">{{count($repairs)}}</h2>
                    <p class="text-white mb-0">Sửa chữa</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="text-primary text-uppercase">// // </h6>
                <h1 class="mb-5">Tin tức</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                @foreach($news as $new)
                    <div class="testimonial-item text-center">
                        <a href="">
                        <img class="bg-light rounded-square p-2 mx-auto mb-3"
                             src="{{asset('new/'.$new->image)}}" style="width: 250px; height: 150px;">
                        <h5 class="mb-0">{{$new->title}}</h5>
                        <p>{{$new->category->name}}</p>
                        </a>
{{--                        <div class="testimonial-text bg-light p-4">--}}
{{--                           {!! \Illuminate\Support\Str::limit($new->content,50) !!}--}}
{{--                           {{\Illuminate\Support\Str::limit($new->content,50)}}--}}
{{--                        </div>--}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
