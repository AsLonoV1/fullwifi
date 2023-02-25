<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'=>'required',
            'phone'=>'required',
            'role_id'=>'required|exists:roles,id',
            'senior_id'=>'required_if:senior_id,true|exists:users,id',
            'warehouse_id'=>'required_if:warehouse_id,true|exists:ware_houses,id',
            'email'=>'required|email|',
            'password'=>'required|string|min:4',
        ];
    }
}                                                                                                                                                                                                   
