<?php

namespace App\Http\Controllers\Api;

use App\Utils\FileHandler;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use \App\Traits\CommonTrait;

class ProductsController extends Controller
{
    use CommonTrait;

    public function index()
    {
        $products = Product::paginate(20);
        foreach ($products as $product) {
            if (!empty($product->image)) {
                $product->image = asset($product->image);
            }
        }

        return response([
            'success' => true,
            'data' => $products
        ]);
    }

   public function getProductsByIds(Request $request)
    {
        $productIds = $request->input('productIds');
        $this->customLog($productIds);
        $products = Product::whereIn('id', $productIds)->paginate(20);
        foreach ($products as $product) {
            if (!empty($product->image)) {
                $product->image = asset($product->image);
            }
        }

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

        $this->customLog($request->all());

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $imagePath = '';
        if($request->hasFile('image')) {
            $name_with_ext = $request->file('image')->getClientOriginalName();
            $name_without_ext = pathinfo($name_with_ext, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $new_filename = $name_without_ext . "_". time() . "." . $extension;
            $imagePath = $request->file('image')->storeAs('uploads', $new_filename, 'public');
            $imagePath = 'storage' . '/' . $imagePath;
        }

        // $product = Product::create($request->all());

        $product = new Product();
        $product->name = trim($request->input('name'));
        $product->price = $request->input('price');
        $product->image = $imagePath;
        $product->description = $request->input('description');
        $product->save();

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

    public function update(Request $request, $id)
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

        $post_data = $request->all();
        unset($post_data['created_at']);
        unset($post_data['updated_at']);

        $product = Product::whereId($id)->update($post_data);
         return response([
            'status' => true,
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