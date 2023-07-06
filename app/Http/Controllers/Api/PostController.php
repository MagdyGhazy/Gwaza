<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\ApiResponseTrait;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Enums\UserRoleEnum;


class PostController extends Controller
{
    use ApiResponseTrait;
    use UploadImage;

    public function index()
    {
        $posts = PostResource::collection(Post::get());
        if ($posts) {
            return $this->apiResponse($posts, 200, 'done');
        } else {
            return $this->apiResponse(null, 404, 'there are no posts');
        }
    }

    public function store(Request $request)
    {
        if ($request->photo == null) {
            $imgPath = null;
        } else {
            $imgPath = $this->uploadImage($request, 'Post/img');
        }
        if ($request->video == null) {
            $vidPath = null;
        } else {
            $vidPath = $this->uploadImage($request, 'Post/vid');
        }
        $posts = Post::create([
            'postBody' => $request->postBody,
            'userId' => auth()->guard('api')->user()->id,
            'photo' => $imgPath,
            'video' => $vidPath,
        ]);
        if ($posts) {
            return $this->apiResponse($posts, 201, 'Add Success');
        }
        return $this->apiResponse(null, 404, 'Cannot Add Post');
    }


    public function update(Request $request,$id){

                $posts = Post::findorfail($id);
                if ($posts->userId == auth()->guard('api')->user()->id) {
                    if ($request->photo == "") {
                        $imgPath = $posts->photo;
                    } else {
                        $imgPath = $this->uploadImage($request, 'Post/img');
                    }
                    if ($request->vedio == "") {
                        $vidPath = $posts->vedio;
                    } else {
                        $vidPath = $this->uploadImage($request, 'Post/vid');
                    }
                    $posts->update([
                        'postBody' => $request->postBody,
                        'userId' => auth()->guard('api')->user()->id,
                        'photo' => $imgPath,
                        'video' => $vidPath,
                    ]);
                    if ($posts) {
                        return $this->apiResponse($posts, 201, 'Ubdate Success');
                    }
                    return $this->apiResponse(null, 404, 'Cannot Ubdate Post');
                }
                return response()->json(['message' => 'you are not permissioned']);
    }

    public function destroy($id){
        $posts = Post::find($id);
        if ($posts){
            $posts->delete();
            return $this->apiResponse(null,200,'Post has been deleted');
        }
        return $this->apiResponse($posts,401,'Cannot Find To delete');

    }
    public function customDestroy($id){
        $posts = Post::find($id);
        if ($posts->userId == auth()->guard('api')->user()->id) {
            if ($posts) {
                $posts->delete();
                return $this->apiResponse(null, 200, 'Post has been deleted');
            }
            return $this->apiResponse($posts, 401, 'Cannot Find To delete');
        }
        return response()->json(['message' => 'you are not permissioned']);
    }
}
