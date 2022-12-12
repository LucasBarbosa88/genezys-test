<?php

namespace App\Http\Requests;

class RegisterAddressRequest extends UserBaseRequest
{
    public function rules()
    {
        return [
            /**
             * @param Model/Address
             */
            "street" => [
                "required",
                "string",
                "max:255"
            ],
            "neighborhood" => [
                "required",
                "string",
                "max:255"
            ],
            "number" => [
                "required",
                "integer",
            ],
            "city" => [
                "required",
                "string",
                "max:255"
            ],
            "state" => [
                "required",
                "string",
                "max:255"
            ],
            "cep" => [
                "required",
                "string",
                "formato_cep",
            ]
        ];
    }
  

}
