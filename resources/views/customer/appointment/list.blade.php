@extends('layouts.client')
@section('content')
    <br>
    <div class="container">
        <table class="table table-responsive">
            <thead>
            <th class="text-center">#</th>
            <th class="text-center">Họ và Tên</th>
            <th class="text-center">Số điện thoại</th>
            <th class="text-center">Thời gian đặt hẹn</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Thời gian tạo</th>
            <th class="text-center">Hành động</th>
            </thead>
            <tbody>
            @php
            $key = 0;
            @endphp
            @foreach($appointments as $appointment)
                <tr>
                    <td class="text-center">{{$key++}}</td>
                    <td class="text-center">{{$appointment->user->fullname}}</td>
                    <td class="text-center">{{$appointment->user->phone}}</td>
                    <td class="text-center">{{$appointment->date_time}}</td>
                    <td class="text-center">{!! $appointment->st !!}</label></td>
                    <td class="text-center">{{$appointment->date_create}}</td>
                    <td class="text-center"><a href=""><i class='fas fa-capsules'></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
