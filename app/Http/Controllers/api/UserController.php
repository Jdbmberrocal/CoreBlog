<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $response = [
            'success' => true,
            'data'    => $users
        ];
        return response()->json($response, 200);
    }
    
    public function store(StoreUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $users = User::create($input);
        $response = [
            'success' => true,
            'data'    => $users
        ];
        return response()->json($response, 200);
    }
   
    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            $response = [
                'success' => true,
                'error'    => "El usuario no existe"
            ];
            return response()->json($response, 404);
        }
        $response = [
            'success' => true,
            'data'    => $user
        ];
        return response()->json($response, 200);
    }
    
    public function update(UpdateUserRequest $request,  $id)
    {
        $data = $request->only('name','lastname','username','email','imagen','estado');

        $user = User::find($id);
            if($user){
                if($user->update($data))
                {
                    return response()->json([
                        "success" => true,
                        "message" => "Registro actualizado con exito!",
                        "data" => $user
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

        $user = User::find($id);
        if($user){
            $user->delete();
            return response()->json([
                "success" => true,
                "message" => "Registro eliminado!",
                "data" => $user
            ]);
        }else{
            return response()->json([
                "success" => false,
                "message" => "Error al eliminar el registro!",
                "data" => $user
            ]);
        }
    }
}
