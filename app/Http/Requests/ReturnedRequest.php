<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReturnedRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "comment"=>"required"
        ];
    }
}
