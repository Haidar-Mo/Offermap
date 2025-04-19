<?php

namespace App\Http\Controllers\Api\Dashboard\Auth;
use App\Models\User;
use App\Enums\TokenAbility;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\Dashboard\Auth\LoginRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{


    public function create(LoginRequest $request)
    {
        $credentials=$request->all();
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message'=>'your password or email is incorrect..!'
            ],401);
        }
        $admin=Auth::user();

        $accessToken = $admin->createToken(
            'access_token',
            [TokenAbility::ACCESS_API->value],
            Carbon::now()->addMinutes(config('sanctum.expiration'))
        );

        $refreshToken = $admin->createToken(
            'refresh_token',
            [TokenAbility::ISSUE_ACCESS_TOKEN->value],
            Carbon::now()->addDays(7)
        );

        return response()->json([
            'message' => 'logged in successfully.',
            'user'=>$admin,
            'access_token' => $accessToken->plainTextToken,
            'refresh_token'=>$refreshToken->plainTextToken,
        ]);


    }

    public function destroy()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully.']);
    }
}
