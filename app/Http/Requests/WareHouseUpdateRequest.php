<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WareHouseUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "code"=>"required_if:title,true|unique:ware_houses,code",
            "title"=>"required_if:title,true|string",
            "type_id"=>"required_if:type_id,true|exists:types,id"
        ];
    }
}   
