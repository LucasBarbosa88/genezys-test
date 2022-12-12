<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\ApiRequest;

class UserBaseRequest extends ApiRequest
{
    public function customAttributes()
    {
        return [
            /**
             * @param Model/User
             */
            "password" => "Password",
            "email" =>"Email",
        ];
    }
}
