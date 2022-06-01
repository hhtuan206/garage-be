@extends('layouts.client')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12 text-center">
                        <h2>{{$new->title}}</h2>
                    </div>
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{asset('new/'.$new->image)}}" alt="" width="250">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! $new->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
