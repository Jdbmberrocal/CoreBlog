<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $users = Category::all();
        $response = [
            'success' => true,
            'data'    => $users
        ];
        return response()->json($response, 200);
    }
    
    public function store(StoreCategoryRequest $request)
    {
        $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        $cats = Category::create($input);
        $response = [
            'success' => true,
            'data'    => $cats
        ];
        return response()->json($response, 200);
    }
   
    public function show($id)
    {
        $cat = Category::find($id);
        if (is_null($cat)) {
            $response = [
                'success' => true,
                'error'    => "La categoría no existe"
            ];
            return response()->json($response, 404);
        }
        $response = [
            'success' => true,
            'data'    => $cat
        ];
        return response()->json($response, 200);
    }
    
    public function update(UpdateCategoryRequest $request,  $id)
    {
        $data = $request->only('name');

        $cat = Category::find($id);
            if($cat){
                if($cat->update($data))
                {
                    return response()->json([
                        "success" => true,
                        "message" => "Registro actualizado con exito!",
                        "data" => $cat
                    ],200);
                }else{
                    return response()->json([
                        "error" => true,
                        "message" => "Errro al actualizar el registro",
                        //"data" => $rdian
                    ],404);
                }
            }else{
                return response()->json([
                    "error" => true,
                    "message" => "El registro no existe",
                ],404); 
            }
        

    }
   
    public function delete($id)
    {

        $cat = Category::find($id);
        if($cat){
            $cat->delete();
            return response()->json([
                "success" => true,
                "message" => "Registro eliminado!",
                "data" => $cat
            ]);
        }else{
            return response()->json([
                "success" => false,
                "message" => "Error al eliminar el registro!",
                "data" => $cat
            ]);
        }
    }
}
