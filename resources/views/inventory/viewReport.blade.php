@include('main.header')

<head>
    <style>
        .text-red {
            color: red!important;
            font-weight: bold!important;
        }

        .text-green {
            color: green!important;
            font-weight: bold!important;
        }
    </style>
</head>

<div class="col-12 text-center">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Product</th>
                <th scope="col">Supplier</th>
                <th scope="col">Category</th>
                <th scope="col">Quantity</th>
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
                    <th class="{{ $result->quantity <= 0 ? 'text-red' : 'text-green' }}">{{$result->quantity}}</th>
                    <th>{{$result->quantity > 0 ? ($result->price / $result->quantity) : ''}}</th>
                    <th>{{$result->quantity > 0 ? $result->price : ''}}</th>
                    <th>{{$result->quantity > 0 ? $result->tax : ''}}</th>
                </tr>
            @endforeach
    </table>
</div>

@include('main.footer')