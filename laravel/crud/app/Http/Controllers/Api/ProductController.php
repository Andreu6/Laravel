<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::update('update products set name = ?, stock = ?, price = ?, category = ? WHERE id = ?', 
        [$request -> name, $request -> stock, $request -> price, $request -> category, $request -> id]);

        return response()->json([
            "status" => 1,
            "msg" => "Update Exitoso"
        ]);
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
