<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\Models\User\RegisterUserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register(Request $request, User $user )
    {
        $new_email = $request->get("email");
        $user = User::where("email", $new_email)->first();
        
        if($user){
            if($user->registration_completed) return response()->json(["message" => "Já possui cadastro"],423);
            return response()->json(["message" => "Continuar cadastro","user" => $user->append()],424);
        }
        
        $data = RegisterUserRequest::validate($request);
        $service = new RegisterUserService($data);

        if( !$user = $service->run() ) return response( null, 503 );
        return response()->json( $user , 201 );

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function recovery(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $email = $request->email;
        $token = random_int(100000, 999999);

        $passwordResets = DB::table('password_resets')->insert([
            'email' => $email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);
        if($passwordResets) 
        {
           $user = User::where('email', $email)->first();
           $user->sendPasswordResetNotification($token);
           if($user)
           {
                return response()->json([
                    'success' => true, 
                    'message' => "Please check your email, we sent a password reset link"
                ], 200);
           }
        }

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
}
