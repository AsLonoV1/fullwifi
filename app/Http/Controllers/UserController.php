<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    
    public function list(Request $request)
    {
        return User::paginate($request->per_page ?: 10);
    }

    public function show($id)
    {
        return User::where('id', $id)->first();
    }

    public function create(UserCreateRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->senior_id = $request->senior_id;
        $user->warehouse_id = $request->warehouse_id;
        $user->password = bcrypt($request->password);
        try {
            $user->save();
            return response()->json(['success'=>'ok']);
        }catch (QueryException $e){
            return response()->json(['error'=>['message'=>$e->getMessage(),'code'=>4551515]],400);
        }
    }

    public function update(UserUpdateRequest $request)
    {
        $user = User::findOrFail($request->id);
        if (!is_null($request->name)) $user->name = $request->name;
        if (!is_null($request->role_id)) $user->role_id = $request->role_id;
        if (!is_null($request->eamil)) $user->email = $request->email;
        if (!is_null($request->phone)) $user->phone = $request->phone;
        if (!is_null($request->senior_id)) $user->senior_id = $request->senior_id;
        if (!is_null($request->warehouse_id)) $user->warehouse_id = $request->warehouse_id;
        if (!is_null($request->password)) $user->password = bcrypt($request->password);
        try {
            $user->save();
            return response()->json($user);
        }catch (QueryException $e){
            return response()->json(['error'=>['message'=>$e->getMessage(),'code'=>1]],400);
        }
    }
    
    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        try {
            $user->delete();
            return response()->json(['success'=>'ok']);
        }catch (QueryException $e){
            return response()->json(['error'=>['message'=>$e->getMessage()]],400);
        }
    }

}
