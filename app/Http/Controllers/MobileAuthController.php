<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class MobileAuthController extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $user = new User();
        $user->role = 'USER';
        $user->name = $request->name;
        $user->phoneNum = $request->phoneNum;
        $user->barangayID = $request->barangayID;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = 'ACTIVE';
        $user->save();

        $mobileToken = JWTAuth::fromUser($user);

        return response()->json([
            'status' => 'success',
            'mobileToken' => $mobileToken,
            'role' => 'USER',
        ], 200);
    }

    /**
     * Login user and return a mobileToken
     */
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    if ($mobileToken = $this->guard()->attempt($credentials)) {
        $user = Auth::user();

        if ($user->role === 'USER' && $user->status === 'ACTIVE') {
            $mobileToken = JWTAuth::fromUser($user);

            return response()->json([
                'status' => 'success',
                'mobileToken' => $mobileToken,
                'role' => 'USER',
            ], 200)->header('Authorization', 'Bearer ' . $mobileToken);
        }

        if ($user->role === 'DRIVER') {
            $mobileToken = JWTAuth::fromUser($user);

            return response()->json([
                'status' => 'success',
                'mobileToken' => $mobileToken,
                'role' => 'DRIVER',
            ], 200)->header('Authorization', 'Bearer ' . $mobileToken);
        }
    }
    return response()->json(['error' => 'login_error'], 401);
}

    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function user()
    {
        $user = User::with('barangay')
        ->find(Auth::user()->id);

        return response()->json($user);
    }

    public function refresh()
    {
        if ($mobileToken = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'success'], 200)
                ->header('Authorization', $mobileToken);
        }
        return response()->json(['error' => 'refresh_mobileToken_error'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
