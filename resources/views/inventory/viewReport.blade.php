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
                <th scope="col">Price Per Unit</th>
                <th scope="col">Total Price</th>
                <th scope="col">Tax</th>
            </tr>
        </thead>
        <tbody>
            @php
                $soldQuantity = 0;
                $totalPaid = 0;
            @endphp

            @foreach($results as $result)
                @php
                    if ($result->quantity > 0) {
                        $soldQuantity += $result->quantity;
                        $totalPaid += $result->price;
                    }
                @endphp

                <tr>
                    <th>{{date_format($result->created_at, 'd/m/Y')}}</th>
                    <th>{{$result->product->name ?? ''}}</th>
                    <th>{{$result->supplier}}</th>
                    <th>{{$result->category}}</th>
                    <th class="{{ $result->quantity <= 0 ? 'text-red' : 'text-green' }}">{{$result->quantity}}</th>
                    <th>{{$result->quantity > 0 ? '$ ' . number_format(($result->price / $result->quantity), 2, '.', ',') : ''}}</th>
                    <th>{{$result->quantity > 0 ? '$ ' . number_format($result->price, 2, '.', ',') : ''}}</th>
                    <th>{{$result->quantity > 0 ? $result->tax : ''}}</th>
                </tr>
            @endforeach
    </table>

    <div class="row mt-5">
        <div class="col-md-4">
            Total quantity sold: 
            <h2 class="text-green">{{$soldQuantity}}</h2>
        </div>

        <div class="col-md-4">
            Average price paid per unit: 
            <h2 class="text-green">$ {{number_format($totalPaid / $soldQuantity, 2, '.', ',')}}</h2>
        </div>

        <div class="col-md-4">
            Total amount paid: 
            <h2 class="text-green">$ {{number_format($totalPaid, 2, '.', ',')}}</h2>
        </div>
    </div>
</div>

@include('main.footer')