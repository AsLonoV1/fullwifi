<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\DocumentProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DocumentRequest;
use Illuminate\Database\QueryException;
use App\Http\Requests\UpdateDocumentRequest;

class WorkmanDocumentController extends Controller
{
    public function abortList()
    {
        return Document::where('status',0)
        ->where('user_id',Auth::user()->id)
        ->with('products')->get();
    }

    public function create(DocumentRequest $request)
    {
        DB::beginTransaction();
        try {
            $document = new Document();
            $document->title = $request->title;
            $document->address = $request->address;
            $document->user_id = Auth::id();
            $document->senior_id = Auth::user()->senior_id;
            $document->save();
            $document_id = $document->id;
            $products = $request->products;
            foreach ($products as $product) {
                $this->addProduct($document_id, $product);
            }
            DB::commit();
            return response()->json(['success' => 'ok']);
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json(['error' => ["message" => $e->getMessage()]],503);
        }
    }

    public function addProduct(int $document_id, array $data)
    {
        $product = new DocumentProduct();
        $product->document_id = $document_id;
        $product->title = $data['title'];
        $product->measure = $data['measure'];
        $product->price = $data['price'];
        $product->count = $data['count'];
        $product->save();
    }
    public function update(UpdateDocumentRequest $request)
    {
        DB::beginTransaction();
        try {
            $document = Document::findOrFail($request->id);
           if(!is_null($request->title)) $document->title = $request->title;
           if(!is_null($request->address))$document->address = $request->address;
            $document->save();
            $products = $request->products;
            foreach ($products as $product) {
                $this->updateProduct($product);
            }
            DB::commit();
            return response()->json(['success' => 'ok']);
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json(['error' => ["message" => $e->getMessage()]],503);
        }
    }
    public function updateProduct(array $data)
    {
        $product = DocumentProduct::findOrFail($data['id']);
        if(!is_null($data['title']))$product->title = $data['title'];
        if(!is_null($data['measure']))$product->measure = $data['measure'];
        if(!is_null($data['price']))$product->price = $data['price'];
        if(!is_null($data['count']))$product->count = $data['count'];
        $product->save();
    }

    public function delete(Request $request)
    {
        $document = Document::findOrFail($request->id);
        try {
            $document->delete();
            return response()->json(['success'=>'ok']);
        }catch (QueryException $e){
            return response()->json(['error'=>['message'=>$e->getMessage()]],400);
        }
    }

}
