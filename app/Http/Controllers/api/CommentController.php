<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Validator;

class CommentController extends Controller
{
    public function index()
    {
        $users = Comment::all();
        $response = [
            'success' => true,
            'data'    => $users
        ];
        return response()->json($response, 200);
    }
    
    public function store(StoreCommentRequest $request)
    {
        $input = $request->all();
        $cats = Comment::create($input);
        $response = [
            'success' => true,
            'data'    => $cats
        ];
        return response()->json($response, 200);
    }
   
    public function show($id)
    {
        $cat = Comment::find($id);
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
    
    public function update(UpdateCommentRequest $request,  $id)
    {
        $data = $request->only('comment','status','user_id','post_id');

        $cat = Comment::find($id);
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

        $cat = Comment::find($id);
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
