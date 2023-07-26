<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skills;
use App\Models\User;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->guard('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            [
                'name'=> $request->name,
                'password' => bcrypt($request->password),
                'email'=> $request->email,
                'address'=> $request->address,
                'latitude'=> $request->latitude,
                'longitude'=> $request->longitude,
                'photo'=> $request->photo,
                'phone'=> $request->phone,
                'gender'=> $request->gender,
                'user_type'=> $request->user_type,

            ]
        ));
        $token = auth()->guard('api')->attempt($validator->validated());
        $this->createNewToken($token);
//        foreach ($request->skills as $skill) {
//            $findSkills = DB::table('Skills')->where('name', $skill)->first();
//            if ($findSkills == null) {
//                $insertSkill = Skills::create(['name' => $skill]);
//                $UserSkill = UserSkill::create([
//                    'user_id' => $user->id,
//                    'skills_id' => $insertSkill->id,
//                ]);
//            } else {
//                UserSkill::create([
//                    'user_id' => $user->id,
//                    'skills_id' => $findSkills->id,
//                ]);
//            }
//        }
        return response()->json([
            'message' => 'User successfully registered',
            'token'=>$token,
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->guard('api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->guard('api')->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->guard('api')->user());
    }

    /**
     * update user profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request) {
       $user = auth()->guard('api')->user();
        $user->update([
            'name'=> $request->name,
            'password' => bcrypt($request->password),
            'email'=> $request->email,
            'address'=> $request->address,
            'latitude'=> $request->latitude,
            'longitude'=> $request->longitude,
            'photo'=> $request->photo,
            'phone'=> $request->phone,
            'gender'=> $request->gender,
            'user_type'=> $request->user_type,
        ]);
        return response()->json([
            'message' => 'User successfully updated',
            'user'=>$user,
        ], 201);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
            'user' => auth()->guard('api')->user()->name
        ]);
    }
}
