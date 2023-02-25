<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Requests\TypeRequest;
class TypeController extends Controller
{
    public function list()
    {
        return Type::limit(10)->get();
    }

    public function create(TypeRequest $request)
    {
        Type::create($request->all());
        return response()->json(['success'=>'ok']);
    }

    public function update(TypeRequest $request)
    {
        $type = Type::findOrFail($request->id);
        $type->update($request->all());
        return response()->json($type);
    }

    public function delete(Request $request)
    {
        $type = Type::findOrFail($request->id);
        $type->delete();
        return response()->json(['success'=>'ok']);
    }
}
