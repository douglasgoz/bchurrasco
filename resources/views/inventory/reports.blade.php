@include('main.header')

<div class="container">
    <div class="col-12 text-center">
        <form action="{{route('generateReport')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-3">
                    <label class="form-label">
                        Product:
                    </label>
                    <select name="product_id" class="form-select text-center">
                        <option value="">All</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <label class="form-label">
                        Category:
                    </label>
                    <select name="category" class="form-select text-center">
                        <option value="">All</option>
                        <option value="meats">Meats</option>
                        <option value="vegs">Vegs</option>
                        <option value="industrializeds">Industrializeds</option>
                    </select>
                </div>
                <div class="col-3">
                    <label class="form-label">
                        Supplier:
                    </label>
                    <input type="text" name="supplier" class="form-control" placeholder="All" />
                </div>
                <div class="col-2">
                    <label class="form-label">
                        Start Date:
                    </label>
                    <input type="date" name="start" class="form-control" />
                </div>
                <div class="col-2">
                    <label class="form-label">
                        Final Date:
                    </label>
                    <input type="date" name="end" class="form-control" />
                </div>  
                <div class="col-4 offset-4 mt-5">                  
                    <button type="submit" class="col-12 btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('main.footer')
