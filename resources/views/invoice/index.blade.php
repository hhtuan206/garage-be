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
                {{$site[0]->content}}
            </div>
            <!-- end invoice-company -->
            <!-- begin invoice-header -->
            <div class="invoice-header">
                <div class="invoice-from">
                    <small>Khách hàng</small>
                    <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">Họ Và Tên: {{$repair->user->fullname}}</strong><br>
                        Địa chỉ: {{$repair->user->address}}<br>
                        Số điện thoại:{{$repair->user->phone}}<br>
                        Email:{{$repair->user->email}}<br>
                    </address>
                </div>
                <div class="invoice-to">
                    <small>Xe</small>
                    <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">Biển số: {{$repair->car->number_plate}}</strong><br>
                        Số máy: {{$repair->car->engine_number}}<br>
                    </address>
                </div>
                <div class="invoice-date">
                    <small>Hóa đơn tháng {{\Illuminate\Support\Facades\Date::now()->month}}</small>
                    <div class="date text-inverse m-t-5">Thời gian: {{$repair->created_at}}</div>
                    <div class="invoice-detail">
                        Mã hóa đơn #{{$repair->id}}<br>

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
                            <th>Dịch vụ</th>
                            <th class="text-center" width="10%">Giá tiền</th>
                            <th class="text-right" width="20%">Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($repair->services as $key => $service)
                            <tr>
                                <td>
                                    <span class="text-inverse">{{$service->name}}</span><br>
                                    <small>{!! $service->detail !!}</small>
                                </td>
                                <td class="text-center">{{number_format($service->price/1000,2)}} VNĐ</td>
                                <td class="text-right">{{number_format($service->price/1000,2)}} VNĐ</td>

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
                                <th>Linh kiện</th>
                                <th class="text-center" width="10%">Số lượng</th>
                                <th class="text-center" width="10%">Đơn vị</th>
                                <th class="text-right" width="10%">Giá</th>
                                <th class="text-right" width="20%">Thành tiền</th>

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
                                    <td class="text-right">{{number_format($component->price/1000,2)}} VNĐ</td>
                                    <td class="text-right">{{number_format((int)$component->price * (int)$component->pivot->quantity/1000,2)}} VNĐ</td>
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
                        <small>Tổng tiền</small> <span
                            class="f-w-600">{{number_format($repair->total_price/1000,2)}} VNĐ</span>
                    </div>
                </div>
                <!-- end invoice-price -->
            </div>
            <!-- end invoice-content -->
            <!-- begin invoice-note -->
            <div class="invoice-note">
                * Make all cheques payable to [Your Company Name]<br>
                * Payment is due within 30 days<br>
                * If you have any questions concerning this invoice, contact [Name, Phone Number, Email]
            </div>
            <!-- end invoice-note -->
            <!-- begin invoice-footer -->
            <div class="invoice-footer">
                <p class="text-center m-b-5 f-w-600">
                    THANK YOU FOR YOUR BUSINESS
                </p>
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
