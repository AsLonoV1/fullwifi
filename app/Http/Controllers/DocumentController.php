<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReturnedRequest;

class DocumentController extends Controller
{
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
    public function list1()
    {
        switch(Auth::user()->role_id){
            case 2: {
                return Document::where('status',2)
                ->where('user_id',Auth::user()->id)
                ->with('products')->get();
             }
            case 3: {
                return Document::where('status',3)
                ->where('senior_id',Auth::user()->id)
                ->with('products')->get();
             }
            case 4: {
                return Document::where('status',4)
                ->with('products')->get();
             }
            case 5: { 
                return Document::where('status',5)
                ->with('products')->get();
            }
        }
    }
    public function send(Request $request)
    {
        switch(Auth::user()->role_id){
            case 2: {
                $workman =Document::findOrFail($request->id);
                $workman->status=3;
                $workman->save();
                break;
            }
            case 3: {
                $chief =Document::findOrFail($request->id);
                $chief->status=4;
                $chief->save();
                break;
            }
            case 4: {
                $director =Document::findOrFail($request->id);
                $director->status=5;
                $director->save();
                break;
            }
        }
        return response()->json(['success'=>'ok']);
       
    }
    public function unsend(ReturnedRequest $request)
    {
        $document =Document::findOrFail($request->id);
        $document->status=0;
        $document->comment=$request->comment;
        $document->save();
        return response()->json(['success'=>'ok']);
    }

}
