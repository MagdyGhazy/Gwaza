<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProviderRequest;
use App\Traits\ApiResponseTrait;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class ProviderRequestController extends Controller
{

    use ApiResponseTrait;
    use UploadImage;

    public function store(Request $request)
    {

        $id_photo_front = $request->file('id_photo_front')->getClientOriginalName();
        $id_photo_front_path = $request->file('id_photo_front')->storeAs('Users/id_photo_front',$id_photo_front,'save');

        $id_photo_back = $request->file('id_photo_back')->getClientOriginalName();
        $id_photo_back_path = $request->file('id_photo_back')->storeAs('Users/id_photo_back',$id_photo_back,'save');

        $criminal_fish = $request->file('criminal_fish')->getClientOriginalName();
        $criminal_fish_path = $request->file('criminal_fish')->storeAs('Users/criminal_fish',$criminal_fish,'save');

        $requests = ProviderRequest::create([
            'id_number' => $request->id_number,
            'user_id' => auth()->guard('api')->user()->id,
            'id_photo_front' => $id_photo_front_path,
            'id_photo_back' => $id_photo_back_path,
            'criminal_fish' => $criminal_fish_path,
        ]);
        if ($requests) {
            return $this->multiableLanguageApiResponse($requests, 'يتم مراجعه طلبك', 'Your request is being reviewed',201);
        }
        return $this->multiableLanguageApiResponse(null, 'خطأ', 'error',404);
    }
}
