@include('main.header')

<div class="col-12 text-center">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Supplier</th>
                <th scope="col">Category</th>
                <th scope="col">Total Price</th>
                <th scope="col">Total Tax</th>
            </tr>
        </thead>
        <tbody>
            @php
                $listedProducts = [];
            @endphp

            @foreach($results as $result)
                @php
                    if (in_array($result->product_id, $listedProducts)) {
                        continue;
                    }

                    $listedProducts[] = $result->product_id;
                @endphp
                <tr>
                    <th>{{$result->product->name ?? ''}}</th>
                    <th>{{$result->supplier}}</th>
                    <th>{{$result->category}}</th>
                    <th>${{$totalPrices[$result->product_id] ?? ''}}</th>
                    <th>${{$totalTaxes[$result->product_id] ?? ''}}</th>
                </tr>
            @endforeach
    </table>
</div>

@include('main.footer')