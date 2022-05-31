@extends('layouts.client')
@section('content')
    <div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                @if($site->appointment)
                    <div class="col-lg-12 text-center">
                        <div
                            class="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn"
                            data-wow-delay="0.6s">
                            <h1 class="text-white mb-4">Đặt lịch hẹn sửa chữa</h1>
                            <form>
                                <div class="row g-3">
                                    <div class="col-12 col-sm-6">
                                        <input type="text" class="form-control border-0"
                                               value="{{Auth::user()->fullname ?? ''}}"
                                               style="height: 55px;" disabled>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <input type="email" class="form-control border-0"
                                               value="{{Auth::user()->phone ?? ''}}"
                                               style="height: 55px;" disabled>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <div class="date" id="date1" data-target-input="nearest">
                                            <input type="datetime-local" name="time"
                                                   class="form-control border-0 datetimepicker-input"
                                                   style="height: 55px;">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-secondary w-100 py-3" type="submit">Đặt lịch ngay
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="col-lg-12 text-center">
                        <div
                            class="bg h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn"
                            data-wow-delay="0.6s">
                            <h1 class="text-white mb-4">Gara tạm thời không nhận đặt lịch,mời bạn quay lại sau</h1>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
