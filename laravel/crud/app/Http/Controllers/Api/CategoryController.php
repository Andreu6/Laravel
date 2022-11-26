<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Category;


class CategoryController extends Controller
{
    public function registerCategory(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required'         

        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return response()->json([
            "status" => 1,
            "msg" => "¡Registro de categoria exitoso!",
        ]);    
    }

    public function updateCategory(Request $request)
    {
       $request->validate(['id' => 'required', 'name' => 'required', 'description' => 'required']);

        DB::update('update categorys set name = ?, description = ? WHERE id = ?', 
        [$request -> name, $request -> description, $request -> id]);

        return response()->json([
            "status" => 1,
            "msg" => "Update Exitoso"
        ]);
    }

    public function deleteCategory(Request $request)
    {

        $request->validate([
            'id' => 'required'
        ]);

        $res = Category::find($request)->each->delete();
        if ($res) {
            $data = [
                'status' => '1',
                'msg' => 'Se ha borrado la categoría'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'No se ha borrado la categoría'
            ];
        }
        return response()->json($data);
    }

    public function readCategory(Request $request) {
        $posts = Category::all();

        return response()->json($posts);
    }

}
