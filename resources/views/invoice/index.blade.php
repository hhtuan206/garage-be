<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/invoice.css')}}">
    <title>Invoice</title>
</head>
<body>

</body>
</html>
<div class="container">
    <div class="col-md-12">
        <div class="invoice">
            <!-- begin invoice-company -->
            <div class="invoice-company text-inverse f-w-600">
            <span class="pull-right hidden-print">
            <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5"><i
                    class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a>
            <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i
                    class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
            </span>
                <img src="{{asset('upload/'.$site->logo)}}" alt="" width="75">
            </div>
            <!-- end invoice-company -->
            <!-- begin invoice-header -->
            <div class="invoice-header">
                <div class="invoice-from">
                    <small>Kh??ch h??ng</small>
                    <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">H??? V?? T??n: {{$repair->user->fullname}}</strong><br>
                        ?????a ch???: {{$repair->user->address}}<br>
                        S??? ??i???n tho???i:{{$repair->user->phone}}<br>
                        Email:{{$repair->user->email}}<br>
                    </address>
                </div>
                <div class="invoice-to">
                    <small>Xe</small>
                    <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">Bi???n s???: {{$repair->car->number_plate}}</strong><br>
                        S??? m??y: {{$repair->car->engine_number}}<br>
                    </address>
                </div>
                <div class="invoice-date">
                    <small>H??a ????n th??ng {{\Illuminate\Support\Facades\Date::now()->month}}</small>
                    <div class="date text-inverse m-t-5">Th???i gian: {{$repair->created_at}}</div>
                    <div class="invoice-detail">
                        M?? h??a ????n #{{$repair->id}}<br>

                    </div>
                </div>
            </div>
            <!-- end invoice-header -->
            <!-- begin invoice-content -->
            <div class="invoice-content">
                <!-- begin table-responsive -->
                <div class="table-responsive">
                    <table class="table table-invoice">
                        <thead>
                        <tr>
                            <th>D???ch v???</th>
                            <th class="text-center" width="10%">Gi?? ti???n</th>
                            <th class="text-right" width="20%">Th??nh ti???n</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($repair->services as $key => $service)
                            <tr>
                                <td>
                                    <span class="text-inverse">{{$service->name}}</span><br>
                                    <small>{!! $service->detail !!}</small>
                                </td>
                                <td class="text-center">{{number_format($service->price/1000,2)}} VN??</td>
                                <td class="text-right">{{number_format($service->price/1000,2)}} VN??</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @if(count($repair->components))
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                            <tr>
                                <th>Linh ki???n</th>
                                <th class="text-center" width="10%">S??? l?????ng</th>
                                <th class="text-center" width="10%">????n v???</th>
                                <th class="text-right" width="10%">Gi??</th>
                                <th class="text-right" width="20%">Th??nh ti???n</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($repair->components as $component)
                                <tr>
                                    <td>
                                        <span class="text-inverse">{{$component->name}}</span><br>
                                        <small>{!! $component->description !!}</small>
                                    </td>
                                    <td class="text-center">{{$component->pivot->quantity}}</td>
                                    <td class="text-center">{{$component->unit}}</td>
                                    <td class="text-right">{{number_format($component->price/1000,2)}} VN??</td>
                                    <td class="text-right">{{number_format((int)$component->price * (int)$component->pivot->quantity/1000,2)}} VN??</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            @endif
            <!-- end table-responsive -->
                <!-- begin invoice-price -->
                <div class="invoice-price">
                    <div class="invoice-price-left">
                        <div class="invoice-price-row">

                        </div>
                    </div>
                    <div class="invoice-price-right">
                        <small>T???ng ti???n</small> <span
                            class="f-w-600">{{number_format($repair->total_price/1000,2)}} VN??</span>
                    </div>
                </div>
                <!-- end invoice-price -->
            </div>
            <!-- end invoice-content -->
            <!-- begin invoice-note -->
            <div class="invoice-note">
                * N???u c?? g?? kh??ng h??i l??ng vui l??ng g???i s??? 0968954324 ????? ???????c h??? tr??? <br>
            </div>
            <!-- end invoice-note -->
            <!-- begin invoice-footer -->
            <div class="invoice-footer">

                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> github.com/hhtuan206</span>
                    <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:0968954324</span>
                    <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> hhtuan206@gmail.com</span>
                </p>
            </div>
            <!-- end invoice-footer -->
        </div>
    </div>
</div>
