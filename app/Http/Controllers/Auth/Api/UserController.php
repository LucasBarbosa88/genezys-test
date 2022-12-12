<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\Models\User\UpdatePasswordService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        $data = UpdatePasswordRequest::validate($request);
        $data['user_id'] = $user->id;
        $updatePasswordService = new UpdatePasswordService($data);
        if( !$updatePassword = $updatePasswordService->run() ) return response( null, 503 );
        return response()->json( $updatePassword , 201 );
    }
}
