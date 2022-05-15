@if(isset($components))
    <table class="table table-hover">
        <thead>
        <th>#</th>
        <th>@lang('vn.Name')</th>
        <th>@lang('vn.Price')</th>
        <th>@lang('vn.Quantity')</th>
        <th>@lang('vn.Discount')</th>
        </thead>
        <tbody>
        @foreach($components as $key => $component)
            <tr>
                <td>{{$key}}</td>
                <td>{{$component->name}}</td>
                <td>{{$component->price}}</td>
                <td><input type="number" name="quantities[]" class="form-control input-solid" min="1" value="1"></td>
                <td>{{$component->discount}}</td>
                <td>{{$component->unit}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
