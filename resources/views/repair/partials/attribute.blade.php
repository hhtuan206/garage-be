@if(isset($attributes))

    @foreach($attributes as $attribute)
            <label for="">{{$attribute->name}}</label>
        {!! Form::select('values[]',$attribute->values->pluck('name','id'),null,['class'=>'form-control input-solid']) !!}
        <br>
    @endforeach

@endif
