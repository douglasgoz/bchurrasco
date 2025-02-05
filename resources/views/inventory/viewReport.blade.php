@include('main.header')

<div class="col-12 text-center">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Product</th>
                <th scope="col">Supplier</th>
                <th scope="col">Category</th>
                <th scope="col">Price Per Unity</th>
                <th scope="col">Total Price</th>
                <th scope="col">Tax</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <th>{{date_format($result->created_at, 'd/m/Y')}}</th>
                    <th>{{$result->product->name ?? ''}}</th>
                    <th>{{$result->supplier}}</th>
                    <th>{{$result->category}}</th>
                    <th>{{$result->price / $result->quantity}}</th>
                    <th>{{$result->price}}</th>
                    <th>{{$result->tax}}</th>
                </tr>
            @endforeach
    </table>
</div>

@include('main.footer')