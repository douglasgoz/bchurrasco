@include('main.header')

<div class="col-8 offset-md-2 text-center">
    <form action="{{route('remove')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="mb-5 col-6">
                <label for="name" class="form-label">
                    Product:
                </label>
                <select name="product_id" class="form-select text-center" value="{{ old('product_id') }}">
                    @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-5 col-4">
                <label for="name" class="form-label">
                    Quantity:
                </label>
                <input type="text" name="quantity" class="form-control" value="{{ old('quantity') }}">
            </div>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary col-2 px-5 mt-5 offset-md-5">        
                Save
            </button>
        </div>
    </form>
</div>

@include('main.footer')