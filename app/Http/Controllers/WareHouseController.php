<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use App\Http\Requests\WareHouseCreateRequest;
use App\Http\Requests\WareHouseUpdateRequest;

class WareHouseController extends Controller
{
    public function list(Request $request)
    {
        return WareHouse::paginate($request->per_page ?: 10);
    }

    public function create(WareHouseCreateRequest $request)
   {
            $warehouse = new WareHouse();
            $warehouse->code = $request->input('code');
            $warehouse->title = $request->input('title');
            $warehouse->type_id = $request->input('type_id');
        try {
            $warehouse->save();
            return response()->json(["success"=>"ok"]);
        } catch (Exception $e) {
            return response()->json(['error' =>['message' => $e->getMessage()]],400);
        }
    }

    public function update(WareHouseUpdateRequest $request)
    {
        $warehouse = WareHouse::findOrFail($request->id);
        $warehouse->update($request->all());
        return response()->json($warehouse);
    }

    public function delete(Request $request)
    {
        $warehouse = WareHouse::findOrFail($request->id);
        $warehouse->delete();
        return response()->json(['success'=>'ok']);
    }
}
