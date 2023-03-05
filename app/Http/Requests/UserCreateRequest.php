<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'=>'required',
            'phone'=>'required',//unique ga tekshirilmagan
            'role_id'=>'required|exists:roles,id',
            'senior_id'=>'required_if:role_id,2|exists:users,id',//required if ni togri ishlatish
            'warehouse_id'=>'required_if:role_id,2|exists:ware_houses,id',
            'email'=>'required|email|', //uniquega tekshirilmagan
            'password'=>'required|string|min:4',
        ];
    }
    //xatolikni ushlab JSON da qaytarish kerak
    protected function failedValidation(Validator $validator)
    {
        dd($validator->errors());
    }

}                                                                                                                                                                                                   
