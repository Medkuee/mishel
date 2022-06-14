<?php

namespace App\Http\Controllers;

use App\Models\CustomUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserAuthentication extends Controller


{
    

    

    // public function login() {
    //     request()->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);
    //     $user = User::where('email', '=', request('email'))->first();
    //     if ($user) {
    //         if (Hash::check(request('password'), $user->password)) {
    //             return "Success, $user->id";
    //         } else {
    //             return "Password incorrect";
    //         }
    //     } else {
    //         return "Email incorrect";
    //     }
    // }
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', "register", "index"]]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized', 'message' => "fail"], 401);
        }

        $userLogin = auth()->user();

        // return $this->respondWithToken($token);
        return response()->json([
            'status' => 'success',
            'data' => [
                'userLogin' => $userLogin,
                'loginToken' => $token
            ]
            ]);
    }

    public function register() {
        request()->validate([
            'password' => 'required',
            'email' => 'required|email'
        ]);
        $userCreate =  User::create([
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);
        return response()->json([
            'status' => 'success',
            'data' => [
                'userCreated' => $userCreate
            ]
            ]);
    }
    public function update(User $user)
    {
        $userResult =  request()->validate([
            'name' => 'required',
            'department' => 'required',
            'year' => 'required',
            'gender' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',

        ]);

        $userr = auth()->user();

        $success = $userr->update($userResult);
        

        return response()->json([
            'data' => [
                'updated' => $success,
                "user" => $userr
            ]
            ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function index() {
        return response()->json([
            "data" => User::all()
        ]); 
        // return User::all();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    



  
}
