<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Traits\CommonTrait;

class ProductsController extends Controller
{
    use CommonTrait;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $product = Product::create($request->all());

        return response([
            'status' => true,
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

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response([
            'success' => true,
            'data' => $product
        ], 200);
    }

}