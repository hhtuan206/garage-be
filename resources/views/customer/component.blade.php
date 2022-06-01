@extends('layouts.client')
@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Thể loại
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($categories as $category)
                            <li class="list-group-item"><a
                                    href="{{route('customer.component',['category'=> $category->id])}}">{{$category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6"><h5 class="card-text ">Danh sách linh kiện</h5></div>
                                <div class="col-md-6 ">
                                    <form action="" method="GET" id="users-form"
                                          class=" align-text-top  border-bottom-light">
                                        <div class="row flex-md-row flex-column-reverse">
                                            <div class="col-md-12">
                                                <div class="input-group custom-search-form">
                                                    <input type="text"
                                                           class="form-control input-solid"
                                                           name="search"
                                                           value="{{ Request::get('search') }}"
                                                           placeholder="@lang('Tìm theo tên sản phẩm')">

                                                    <span class="input-group-append">
                                                        @if (Request::has('search') && Request::get('search') != '')
                                                            <a href="{{ route('customer.component') }}"
                                                               class="btn btn-light d-flex align-items-center text-muted"
                                                               role="button">
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>


                        <div class="card-body">
                            @foreach($components->chunk(4) as $componentC)
                                <div class="row">
                                    @foreach($componentC as $key => $component)
                                        <div class="col">
                                            <div class="card">
                                                <img src="{{asset('component/'.$component->image)}}"
                                                     class="card-img-top" alt="{{$component->name}}" width="75"
                                                     height="75" loading=lazy>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$component->name}}</h5>
                                                    <p class="card-text">Giá: {{$component->prices}}
                                                        đ/{{$component->unit}}</p>
                                                    <p class="card-text text-light">
                                                        @if($component->stock)
                                                            <label class=" bg bg-success"> Còn hàng</label>
                                                        @else
                                                            <label class=" bg bg-warning text-dark"> Hết hàng</label>

                                                        @endif
                                                    </p>

                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal"
                                                            data-bs-whatever="{{$component->id}}">Chi tiết
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            {!! $components->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('customer.modals.detail')
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var exampleModal = document.getElementById('exampleModal')
            exampleModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-bs-whatever')
                $.ajax({
                    'url': '/detailComponent/' + id,
                    'type': 'get',

                }).done(function (res) {

                    $('#exampleModalLabel').html(res.name)
                    $('#imgCom').attr('src', '{{asset('component/')}}/' + res.image)
                    $('#priceCom').html('Giá : ' + res.price + ' đ/' + res.unit)
                    $('#descCom').html('Mô tả: ' + res.description)

                }).fail(function (err) {
                    console.log(err)
                })
            })
        })
    </script>
@endsection
