<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WareHouseCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "code"=>"required|unique:ware_houses,code",
            "title"=>"required|string",
            "type_id"=>"required_if:type_id,true|exists:types,id"
        ];
    }
}
