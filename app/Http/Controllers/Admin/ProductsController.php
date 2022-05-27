<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function redirect;
use function view;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::paginate(20);
        return view('admin.products.index', compact('products', ) );
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);
        if($validator->fails()) {
            echo "<pre>";
            print_r($validator->errors());
            echo "</pre>";
            die();
//            return response()->json([
//                'success' => false,
//                'message' => $validator->errors()
//            ]);
        }
        $post_data = $request->all();
        $product = Product::create($post_data);
        return redirect('/products')->with('success', 'Product has been created');
    }
}