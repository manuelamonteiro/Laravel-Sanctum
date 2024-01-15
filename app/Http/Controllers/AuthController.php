<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//2|4R73y4ZpXQ0KyCCpDQz4aR9sIdDZkgTg3GJkQtmi9bf3561d

class AuthController extends Controller
{
    use HttpResponses;
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('invoice')->plainTextToken;
            \Log::info("Token criado: $token");
            return $this->response('Authorized', JsonResponse::HTTP_OK, ['token' => $token]);
        }

        return $this->response("Not Authorized", JsonResponse::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->response("Token Revoked", JsonResponse::HTTP_OK);
    }
}
