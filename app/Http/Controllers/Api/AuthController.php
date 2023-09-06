<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Skills;
use App\Models\User;
use App\Models\UserSkill;
use App\Traits\ApiResponseTrait;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    use ApiResponseTrait;
    use UploadImage;


    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'country_code'=> 'required',
            'phone'=>'required',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->guard('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
         $this->createNewToken($token);
        return $this->multiableLanguageApiResponse(['access_token'=>$token, 'user'=>auth()->guard('api')->user()], 'تم تسجيل الدخول', 'Your are logged in',200);

    }


    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($request->photo == null) {
            $imgPath = null;
        } else {
            $imgPath = $this->uploadImage($request, 'User/img');
        }

        $urlPath =asset('img/'.$imgPath);


        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            [
                'first_name'=> $request->first_name,
                'last_name'=> $request->last_name,
                'password' => bcrypt($request->password),
//                'email'=> $request->email,
                'governorate'=> $request->governorate,
                'city'=> $request->city,
//                'photo'=> $imgPath,
                'country_code'=> $request->country_code,
                'phone'=> $request->phone,
                'gender'=> $request->gender,
                'user_type'=> UserRoleEnum::VISITOR,

            ]
        ));
        $token = auth()->guard('api')->attempt($validator->validated());
        $this->createNewToken($token);

        return $this->multiableLanguageApiResponse(['access_token'=>$token, 'user'=>$user], 'تم التسجيل بنجاح', 'User successfully registered',200);

    }


    public function logout() {
        auth()->guard('api')->logout();
        return $this->apiResponse(null, 'User successfully signed out',200 );
    }


    public function refresh() {
        return $this->createNewToken(auth()->guard('api')->refresh());
    }


    public function userProfile() {
        return response()->json(auth()->guard('api')->user());
    }


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


    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
            'user' => auth()->guard('api')->user()
        ]);
    }
}
