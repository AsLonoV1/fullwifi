<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title"=>"required_if:title,true|unique:types,title"
        ];
    }
}
