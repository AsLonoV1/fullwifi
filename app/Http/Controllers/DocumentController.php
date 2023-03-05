<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReturnedRequest;

class DocumentController extends Controller
{
    public static $status = [
        2 => 3,
        3 => 4,
        4 => 5
    ];
    // public function list()
    // {
    //     switch(Auth::user()->role_id){
    //         case 2: $where =['user_id',Auth::user()->id];
    //         // case 3: {
    //         //     return Document::where('status',3)
    //         //     ->where('senior_id',Auth::user()->id)
    //         //     ->with('products')->get();
    //         //  }
    //         //  case 4: {
    //         //      return Document::where('status',4)
    //         //      ->with('products')->get();
    //         //     }
    //         //     case 5: { 
    //         //         return Document::where('status',5)
    //         //         ->with('products')->get();
    //         //     }
    //     }
    //     return Document::where($where)->with('products')->get();
    // }
    public function list()
    {
        switch (Auth::user()->role_id) {
            case 2: {
                    $where = [
                        ['status', 2],
                        ['user_id', Auth::user()->id]
                    ];
                    break;
                }
            case 3: {
                    $where = [
                        ['status', 3],
                        ['user_id', Auth::user()->id]
                    ];
                    break;
                }
            case 4: {
                    $where = ['status', 4];
                    break;
                }
            case 5: {
                    $where = ['status', 4];
                    break;
                }
        }
        return Document::where($where)->with('products')->get();
    }
    public function send(Request $request)
    {
        $this->updateStatus($request->id, self::$status[Auth::user()->role_id]);
        return response()->json(['success' => 'ok']);
    }
    public function updateStatus($id, $status)
    {
        $director = Document::findOrFail($id);
        $director->status = $status;
        $director->save();
    }
    public function unsend(ReturnedRequest $request)
    {
        $document = Document::findOrFail($request->id);
        $document->status = 0;
        $document->comment = $request->comment;
        $document->save();
        return response()->json(['success' => 'ok']);
    }
}
