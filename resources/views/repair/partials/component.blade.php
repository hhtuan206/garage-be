@if(isset($components))
    <table class="table table-hover">
        <thead>
        <th>#</th>
        <th>@lang('vn.Name')</th>
        <th>@lang('vn.Price')</th>
        <th>@lang('vn.Quantity')</th>
        <th>Đơn vị</th>
        <th>Tồn kho</th>
        </thead>
        <tbody>
        @foreach($components as $key => $component)
            <tr>
                <td>{{$key}}</td>
                <td>{{$component->name}}</td>
                <td>{{$component->prices}} đ</td>
                <td><input type="number" name="quantities[]" class="form-control input-solid" min="1" value="1" max="{{$component->stock}}"></td>
                <td>{{$component->unit}}</td>
                <td>{{$component->stock}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
