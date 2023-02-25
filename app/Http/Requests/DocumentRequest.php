<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title" => "required|string",
            "address" => "required|string",
            "products" => "required|array|min:1",
            "products.*.title" => "required|string",
            "products.*.measure" => "required|string",
            "products.*.price" => "required|int",
            "products.*.count" => "required|int",
        ];
    }
}
