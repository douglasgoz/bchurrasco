<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

class StockController extends Controller
{
    public function supply()
    {
        return view('inventory.supply')->with([
            'products' => Product::get(['id', 'name']),
            'menu' => 'supply',
        ]);
    }

    public function add(Request $request)
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|integer',
                'quantity' => 'required',
            ]);

            $product = Product::findOrFail($request->product_id);
            $stock = new Stock();
            $stock->product_id = $request->product_id;
            $stock->quantity = $request->quantity;
            $stock->category = $product->category;
            $stock->price = $request->price;
            $stock->supplier = $request->supplier;
            $stock->tax = $request->tax ?? 0;
            $stock->created_at = Carbon::now();
            $stock->save();

            toastr()->success('Data has been saved successfully!');
            return back();
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage(), 'Error:');
            return back();
        }
    }

    public function sell()
    {
        return view('inventory.sell')->with([
            'products' => Product::get(['id', 'name']),
            'menu' => 'sell',
        ]);
    }

    public function remove(Request $request)
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|integer',
                'quantity' => 'required',
            ]);

            $stock = new Stock();
            $stock->product_id = $request->product_id;
            $stock->quantity = -($request->quantity);
            $stock->save();

            toastr()->success('Data has been saved successfully!');
            return back();
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage(), 'Error:');
            return back();
        }
    }

    public function reports()
    {
        return view('inventory.reports')->with([
            'products' => Product::get(['id', 'name']),
            'menu' => 'reports',
        ]);
    }

    public function generateReport(Request $request)
    {
        try {
            $validated = $request->validate([
                'start' => 'required',
                'end' => 'required',
            ]);
    
            $results = Stock::whereBetween('created_at', [$request->start . ' 00:00:00', $request->end . ' 23:59:59']);
    
            if (!is_null($request->product_id)) {
                $results = $results->where('product_id', $request->product_id);
            }
    
            if (!is_null($request->category)) {
                $results = $results->where('category', 'like', $request->category);
            }
    
            if (!is_null($request->supplier)) {
                $results = $results->where('supplier', 'like', $request->supplier);
            }

            $results = $results->with('product')->get();

            return view('inventory.viewReport')->with([
                'results' => $results,
                'menu' => 'reports'
            ]);
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage(), 'Error:');
            return back();
        }
    }
}
