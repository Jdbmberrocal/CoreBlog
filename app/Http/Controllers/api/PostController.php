<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Validator;

class PostController extends Controller
{
    public function index()
    {
        $users = Post::all();
        $response = [
            'success' => true,
            'data'    => $users
        ];
        return response()->json($response, 200);
    }
    
    public function store(StorePostRequest $request)
    {
        $input = $request->all();
        $cats = Post::create($input);
        $response = [
            'success' => true,
            'data'    => $cats
        ];
        return response()->json($response, 200);
    }
   
    public function show($id)
    {
        $cat = Post::find($id);
        if (is_null($cat)) {
            $response = [
                'success' => true,
                'error'    => "La post no existe"
            ];
            return response()->json($response, 404);
        }
        $response = [
            'success' => true,
            'data'    => $cat
        ];
        return response()->json($response, 200);
    }
    
    public function update(UpdatePostRequest $request,  $id)
    {
        $data = $request->only('title','description','meta_tags','meta_description','image','content','status','user_id','category_id');

        $cat = Post::find($id);
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
                        "message" => "Errro al actualizar el registro"
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

        $cat = Post::find($id);
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
