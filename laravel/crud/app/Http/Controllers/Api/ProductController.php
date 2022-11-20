<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;


class ProductController extends Controller
{
    public function registerProduct(Request $request) {
        $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'category' => 'required'      
                 
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->save();

        return response()->json([
            "status" => 1,
            "msg" => "¡Registro de producto exitoso!",
        ]);    
    }

    public function updateProduct(Request $request) {
        $request->validate(['id' => 'required', 'name' => 'required', 'stock' => 'required', 'price' => 'required', 'category' => 'required']);

        $post = Product::update(
            ['name' => $request->name, 'stock' => $request->stock, 'price' => $request->price, 'category' => $request->category],
            ['id' => $request->id]
        );
        if ($post) {
            $data = [
                'status' => '1',
                'msg' => 'Se ha actualizado el producto'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'No se ha actualizado el producto'
            ];
        }
        return response()->json($data);
    }

    public function deleteProduct(Request $request)
    {

        $request->validate([
            'id' => 'required'
        ]);

        $res = Product::find($request)->each->delete();
        if ($res) {
            $data = [
                'status' => '1',
                'msg' => 'Se ha borrado el producto'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'No se ha borrado el producto'
            ];
        }
        return response()->json($data);
    }

    public function readProduct(Request $request) {
        $posts = Product::all();

        return response()->json($posts);
    }
}
