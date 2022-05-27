<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Products extends Controller
{

    public function index()
    {
        $products = Product::paginate(20);
        return response([
            'success' => true,
            'data' => $products
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($data);

        return response([
            'success' => true,
            'data' => $product
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response([
            'success' => true,
            'data' => $product
        ]);
    }

}