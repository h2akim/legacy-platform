<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Business;
use App\Product;

class DataController extends Controller
{
    public function fetchDetails(Request $request, $business) {
        $business = Business::findByUniqueId($business);
        $product = Product::withTrashed()->where('business_id', $business->id)->where('unique_id', $request->productId)->first();
        //$product = $business->products()->withTrashed()->where('unique_id', $request->productId)->first();
        return response()->json($product);
    }

    public function saleDetailsProduct(Request $request, $business) {
        $business = Business::findByUniqueId($business);
        $product = Product::withTrashed()->where('business_id', $business->id)->where('unique_id', $request->product)->first();
        // pending check if selling price is different - setting on open order

        return response()->json(view('sales.product-details')->with('product', $product)->render());
    }

}
