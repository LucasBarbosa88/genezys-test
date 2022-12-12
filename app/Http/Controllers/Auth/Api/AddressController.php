<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAddressRequest;
use App\Services\Models\Address\RegisterAddressService;
use App\Services\Models\User\RegisterUserAddressService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function registerAddress(Request $request)
    {   
        //Address
        $data = RegisterAddressRequest::validate($request);
        $serviceAddress = new RegisterAddressService($data);
        if( !$address = $serviceAddress->run() ) return response( null, 503 );
        // User Address
        $dataUserAddress['address_id'] = $address->id;
        $dataUserAddress['user_id'] = $request->user_id;
        $serviceUserAddress = new RegisterUserAddressService($dataUserAddress);
        if( !$userAddress = $serviceUserAddress->run() ) return response( null, 503 );
        return response()->json( $address , 201 );
    }
}
