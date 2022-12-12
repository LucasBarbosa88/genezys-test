<?php

namespace App\Http\Requests;

class UpdatePasswordRequest extends UserBaseRequest
{
    public function rules()
    {
        return [
            /**
             * @param Model/User
             */
            "password" => [
                'required',
                'confirmed'
            ]
        ];
    }
  

}
