<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') - {{ setting('app_name') }}</title>

    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ url('assets/img/icons/apple-touch-icon-144x144.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
          href="{{ url('assets/img/icons/apple-touch-icon-152x152.png') }}"/>
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon-16x16.png') }}" sizes="16x16"/>
    <meta name="application-name" content="{{ setting('app_name') }}"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="{{ url('assets/img/icons/mstile-144x144.png') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link media="all" type="text/css" rel="stylesheet" href="{{ url(mix('assets/css/vendor.css')) }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url(mix('assets/css/app.css')) }}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">

    @yield('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @hook('app:styles')

</head>
<body>
@include('partials.navbar')

<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar.main')

        <div class="content-page">
            <main role="main" class="px-4">
                @yield('content')
            </main>
        </div>
    </div>
</div>

<script src="{{ url(mix('assets/js/vendor.js')) }}"></script>
<script src="{{ url('assets/js/as/app.js') }}"></script>

@yield('scripts')
@hook('app:scripts')
</body>
</html>
