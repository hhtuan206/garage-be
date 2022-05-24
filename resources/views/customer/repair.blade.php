@extends('layouts.client')
@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
            <th class="text-center">#</th>
            <th class="text-center">Họ và Tên</th>
            <th class="text-center">Xe</th>
            <th class="text-center">Dịch vụ</th>
            <th class="text-center">Tổng tiền</th>
            <th class="text-center">Ngày sửa chữa</th>
            <th class="text-center">Hành động</th>
            </thead>
            <tbody>
            @foreach($repairs as $key => $repair)
                <tr>
                    <td class="text-center">{{$key}}</td>
                    <td class="text-center">{{$repair->user->fullname}}</td>
                    <td class="text-center">{{$repair->car->number_plate}}</td>
                    <td class="text-center">
                        @foreach($repair->services as $service)
                            <label for="" class="badge bg-primary">{{$service->name}}</label>
                        @endforeach
                    </td>
                    <td class="text-center">{{$repair->total}} đ</td>
                    <td class="text-center">{{$repair->date_repair}}</td>
                    <td class="text-center"><a href="{{route('repairs.show',$repair)}}"><i class='fas fa-money-bill'></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
