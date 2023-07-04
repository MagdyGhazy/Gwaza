<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\ApiResponseTrait;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponseTrait;
    use UploadImage;

    public function index()
    {
        $posts = PostResource::collection(Post::get());
        if ($posts) {
            return $this->apiResponse($posts,200,'done');
        }else{
            return $this->apiResponse(null, 404, 'there are no posts');
        }
    }

    public function store(Request $request)
    {
//        if ($request->image == "") {
//            $imgPath = $request->image;
//        }else{
//            $imgPath = $this->uploadImage($request, 'Post/img');
//        }
//
//        if ($request->video == "") {
//            $vidPath = $request->video;
//        }else{
//            $vidPath = $this->uploadImage($request, 'Post/vid');
//        }
//
//        $posts =  Post::create([
//            'postBody'=> $request->postBody,
//            'userId'=> $request->userId,
//            'photo'=> $imgPath,
//            'video'=> $vidPath,
//        ]);
//        if ($posts){
//            return $this->apiResponse($posts,201,'Add Success');
//        }
//        return $this->apiResponse(null,404,'Cannot Add Post');
        return $request;
    }
}
