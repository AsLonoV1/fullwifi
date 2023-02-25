<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title" => "required_if:title,true|string",
            "address" => "required_if:address,true|string",
            "products" => "required_if:products,true|array|min:1",
            "products.*.title" => "required_if:title,true|string",
            "products.*.measure" => "required_if:measure,true|string",
            "products.*.price" => "required_if:price,true|int",
            "products.*.count" => "required_if:count,true|int",
        ];
    }
}
