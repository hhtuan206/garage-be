<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CarServ - Car Repair HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap"
          rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('clients')}}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{asset('clients')}}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{asset('clients')}}/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet"/>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('clients')}}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('clients')}}/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
</head>

<body>
<!-- Spinner Start -->
<div id="spinner"
     class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->


<!-- Topbar Start -->
@if(Auth::check())
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fas fa-hashtag text-primary me-2"></small>
                    <small>{{(Auth::user()) ?'Xin chào '.Auth::user()->full_name:''}}</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="fas fa-phone-alt text-primary me-2"></small>
                    <small>{{(Auth::user()) ?Auth::user()->phone:''}}</small>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><img src="{{asset('upload/'.$site->logo)}}" alt="{{config('app.name')}}"
                                          width="75"></h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="/" class="nav-item nav-link active">Trang chủ</a>
            <a href="{{route('customer.about')}}" class="nav-item nav-link">Giới thiệu</a>
            <a href="{{route('customer.service')}}" class="nav-item nav-link">Dịch vụ</a>
            <a href="{{route('customer.component')}}" class="nav-item nav-link">Linh kiện</a>

            @if(Auth::check())
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Tài khoản</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="{{route('customer.viewRepair')}}" class="dropdown-item">Lịch sử sửa chữa</a>
                        <a href="{{route('customer.viewAppointment')}}" class="dropdown-item">Lịch sử đặt lịch</a>
                        <a href="{{route('customer.profile')}}" class="dropdown-item">Cập nhập tài khoản</a>
                        <a href="{{route('auth.logout')}}" class="dropdown-item">Đăng xuất</a>
                    </div>
                </div>
            @else
                <a href="{{route('register')}}" class="nav-item nav-link">Đăng ký</a>
                <a href="{{route('login')}}" class="nav-item nav-link">Đăng nhập</a>
            @endif

        </div>
        <a href="{{route('customer.appointment')}}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Đặt lịch ngay<i
                class="fa fa-arrow-right ms-3"></i>
        </a>
    </div>
</nav>
<!-- Navbar End -->

@yield('content')


<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-6 col-md-6 text-left">
                <h4 class="text-light mb-4 ">Liên hệ</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{$site->address ?? ''}}</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{$site->phone ?? ''}}</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{$site->email ?? ''}}</p>
            </div>
            <div class="col-lg-6 col-md-6 text-center">
                <h4 class="text-light mb-4">Giờ làm việc</h4>
                <h6 class="text-light">{{$site->open_hour}}</h6>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row text-center">
                <div class="col-md-12 text-center mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">{{config('app.name')}}</a>, All Right Reserved.

                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a class="border-bottom" href="https://www.facebook.com/hht206">HHT</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('clients')}}/lib/wow/wow.min.js"></script>
<script src="{{asset('clients')}}/lib/easing/easing.min.js"></script>
<script src="{{asset('clients')}}/lib/waypoints/waypoints.min.js"></script>
<script src="{{asset('clients')}}/lib/counterup/counterup.min.js"></script>
<script src="{{asset('clients')}}/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="{{asset('clients')}}/lib/tempusdominus/js/moment.min.js"></script>
<script src="{{asset('clients')}}/lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="{{asset('clients')}}/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="{{asset('clients')}}/js/main.js"></script>
@yield('scripts')
</body>

</html>
