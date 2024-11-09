<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.dashboard')->with([
            'products' => Product::all(), 
            'menu' => 'products'
        ]);
    }

    public function add(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'category' => 'required',
                'measure' => 'required',
            ]);

            $product = new Product();
            $product->created_by = Session::get('userID');
            $product->name = $request->name;
            $product->category = $request->category;
            $product->measure = $request->measure;
            $product->save();

            toastr()->success('Data has been saved successfully!');
            return back();
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage(), 'Error:');
            return back();
        }
    }

    public function delete(int $productID)
    {
        try {
            Product::find($productID)->delete();
            toastr()->success('Data has been deleted successfully!');
            return back();
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage(), 'Error:');
            return back();
        }
    }
}
