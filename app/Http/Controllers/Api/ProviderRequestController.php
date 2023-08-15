<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\ProviderRequest;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderRequestController extends Controller
{

    use ApiResponseTrait;
    use UploadImage;

    public function store(Request $request)
    {
        if ($request->photo == null) {
            $imgPath = null;
        } else {
            $imgPath = $this->uploadImage($request, 'User/photo');
        }

        $id_photo_front = $request->file('id_photo_front')->getClientOriginalName();
        $id_photo_front_path = $request->file('id_photo_front')->storeAs('User/id_photo_front',$id_photo_front,'save');

        $id_photo_back = $request->file('id_photo_back')->getClientOriginalName();
        $id_photo_back_path = $request->file('id_photo_back')->storeAs('User/id_photo_back',$id_photo_back,'save');

        $criminal_fish = $request->file('criminal_fish')->getClientOriginalName();
        $criminal_fish_path = $request->file('criminal_fish')->storeAs('User/criminal_fish',$criminal_fish,'save');

        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            [
            'first_name'=> $request->first_name,
            'mid_name'=> $request->mid_name,
            'last_name'=> $request->last_name,
            'password' => bcrypt($request->password),
//          'email'=> $request->email,
            'photo'=> $imgPath,
            'governorate'=> $request->governorate,
            'city'=> $request->city,
//          'latitude'=> $request->latitude,
//          'longitude'=> $request->longitude,
            'country_code'=> $request->country_code,
            'phone'=> $request->phone,
            'gender'=> $request->gender,
            'user_type'=> UserRoleEnum::VISITOR,
            ]
        ));

        $token = auth()->guard('api')->attempt($validator->validated());
        $this->createNewToken($token);


        $requests = ProviderRequest::create([

            'user_id'=> $user->id,
            'photo'=> $imgPath,
            'id_number'=> $request->id_number,
            'id_photo_front' => $id_photo_front_path,
            'id_photo_back' => $id_photo_back_path,
            'criminal_fish' => $criminal_fish_path,
            'provider_type'=> $request->provider_type,



        ]);
        if (!$requests) {
            return $this->multiableLanguageApiResponse(null, 'خطأ', 'error',404);
        }
        return response()->json([
            'message ar' => 'يتم مراجعه طلبك',
            'message en' => 'Your request is being reviewed',
            'token'=>$token,
            'user'=>$user,

        ], 201);
    }

    public function update(Request $request){

        if ($request->photo == null) {
            $imgPath = null;
        } else {
            $imgPath = $this->uploadImage($request, 'User/photo');
        }

        $id_photo_front = $request->file('id_photo_front')->getClientOriginalName();
        $id_photo_front_path = $request->file('id_photo_front')->storeAs('User/id_photo_front',$id_photo_front,'save');

        $id_photo_back = $request->file('id_photo_back')->getClientOriginalName();
        $id_photo_back_path = $request->file('id_photo_back')->storeAs('User/id_photo_back',$id_photo_back,'save');

        $criminal_fish = $request->file('criminal_fish')->getClientOriginalName();
        $criminal_fish_path = $request->file('criminal_fish')->storeAs('User/criminal_fish',$criminal_fish,'save');

        $validator = Validator::make($request->all(), [
            'id_number' => 'required|unique:provider_requests',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $requests = ProviderRequest::create([

            'user_id'=> auth()->guard('api')->user()->id,
            'photo'=> $imgPath,
            'id_number'=> $request->id_number,
            'id_photo_front' => $id_photo_front_path,
            'id_photo_back' => $id_photo_back_path,
            'criminal_fish' => $criminal_fish_path,
            'provider_type'=> $request->provider_type,
        ]);
        if (!$requests) {
            return $this->multiableLanguageApiResponse(null, 'خطأ', 'error',404);
        }
        return response()->json([
            'message ar' => 'يتم مراجعه طلبك',
            'message en' => 'Your request is being reviewed',
            'request_data'=>$requests,

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
