<?php

namespace App\Http\Controllers\Api;

use App\Utils\FileHandler;
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
        sleep(10);
        $this->customLog($request->all());



        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }
        if ($request->get('image')) {
            $file_handler = new FileHandler();
            //$result = $file_handler->upload($request->get('image'), $upload_file_path, ['xls','xlsx']);
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