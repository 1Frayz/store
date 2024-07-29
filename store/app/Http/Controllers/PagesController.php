<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;

class PagesController extends Controller
{
    public function product_list()
    {
        $products = Product::with('additionalField')->get();
        return view('layouts.product_list', compact('products'));
    }


    public function product($external_code)
    {
        $product = Product::with('additionalField', 'images')
            ->where('external_code', $external_code)
            ->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return view('layouts.product', compact('product'));
    }

    public function upload()
    {
        return view('layouts.upload');
    }
}
