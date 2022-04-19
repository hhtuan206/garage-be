@if(isset($components))
    <table class="table table-hover">
        <thead>
        <th>#</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Discount</th>
        </thead>
        <tbody>
        @foreach($components as $key => $component)
            <tr>
                <td>{{$key}}</td>
                <td>{{$component->name}}</td>
                <td>{{$component->price}}</td>
                <td><input type="number" name="quantity[]" class="form-control input-solid"></td>
                <td>{{$component->discount}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
