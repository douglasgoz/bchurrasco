@include('main.header')

<button type="button" class="btn btn-primary mb-5 px-5" data-bs-toggle="modal" data-bs-target="#addProductModal" style="float: right;">
  New Product
</button>

<div class="col-12 text-center">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Stock</th>
                <th scope="col">Category</th>
                <th scope="col">Measure</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <th>{{$product->name}}</th>
                    <th>{{$product->stock}}</th>
                    <th>{{$product->category}}</th>
                    <th>{{$product->measure}}</th>
                    <th>
                        <a href="{{route('deleteProduct', ['productID' => $product->id])}}" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" fill="#fff"><path d="M312-144q-29.7 0-50.85-21.15Q240-186.3 240-216v-480h-48v-72h192v-48h192v48h192v72h-48v479.57Q720-186 698.85-165T648-144H312Zm336-552H312v480h336v-480ZM384-288h72v-336h-72v336Zm120 0h72v-336h-72v336ZM312-696v480-480Z"/></svg>
                        </a>
                    </th>
                </tr>
            @endforeach
    </table>
</div>

<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('addProduct')}}" method="post" enctype="multipart/form-data">
        <div class="modal-body text-center">
            @csrf
            <div class="row my-5 px-5">
                <div class="col-6">
                    <label for="name" class="form-label">
                        Name:
                    </label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="col-4">
                    <label for="category" class="form-label">
                        Category:
                    </label>
                    <select name="category" class="form-select text-center" value="{{ old('product_id') }}">
                        <option value="meats">Meats</option>
                        <option value="vegs">Vegs</option>
                        <option value="industrializeds">Industrializeds</option>
                    </select>
                </div>
                <div class="col-2">
                    <label for="measure" class="form-label">
                        Measure:
                    </label>
                    <select name="measure" class="form-select text-center" value="{{ old('product_id') }}">
                        <option value="g">G</option>
                        <option value="ml">ML</option>
                        <option value="unit">Unit</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary px-4">Create</button>
        </div>
    </form>
    </div>
  </div>
</div>

@include('main.footer')