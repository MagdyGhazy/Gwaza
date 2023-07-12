<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Skills;
use App\Models\UserSkill;
use App\Traits\ApiResponseTrait;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\DB;


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
            $vidPath = $this->uploadVedio($request, 'Post/vid');
        }
        $posts = Post::create([
            'postBody' => $request->postBody,
            'userId' => auth()->guard('api')->user()->id,
            'photo' => $imgPath,
            'video' => $vidPath,
        ]);
        if ($posts) {
            return $this->apiResponse(new PostResource($posts), 201, 'Add Success');
        }
        return $this->apiResponse(null, 404, 'Cannot Add Post');
    }
    public function update(Request $request,$id){
        $posts = Post::find($id);
        if ($posts) {
            if ($posts->userId == auth()->guard('api')->user()->id) {
                if ($request->photo == "") {
                    $imgPath = $posts->photo;
                } else {
                    $imgPath = $this->uploadImage($request, 'Post/img');
                }
                if ($request->vedio == "") {
                    $vidPath = $posts->vedio;
                } else {
                    $vidPath = $this->uploadVedio($request, 'Post/vid');
                }
                $posts->update([
                    'postBody' => $request->postBody,
                    'userId' => auth()->guard('api')->user()->id,
                    'photo' => $imgPath,
                    'video' => $vidPath,
                ]);
                if ($posts) {
                    return $this->apiResponse(new PostResource($posts), 201, 'Update Success');
                }
                return $this->apiResponse(null, 404, 'Cannot Update Post');
            }
            return response()->json(['message' => 'you are not permissioned']);
        }
        return $this->apiResponse($posts,401,'Cannot Find To Update');
    }
    public function likePost($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->like(auth()->guard('api')->user()->id);
            $post->save();
            if ($post) {
                return $this->apiResponse(new PostResource($post), 201, 'Post Liked');
            }
            return $this->apiResponse(null, 404, 'Cannot Like Post');
        }
        return $this->apiResponse($post,401,'Cannot Find To Like');
    }
    public function unlikePost($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->unlike(auth()->guard('api')->user()->id);
            $post->save();

            if ($post) {
                return $this->apiResponse(new PostResource($post), 201, 'Post UnLiked');
            }
            return $this->apiResponse(null, 404, 'Cannot UnLike Post');
        }
        return $this->apiResponse($post,401,'Cannot Find To UnLike');
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
        if ($posts) {
            if ($posts->userId == auth()->guard('api')->user()->id) {
                $posts->delete();
                return $this->apiResponse(null, 200, 'Post has been deleted');
            }
            return response()->json(['message' => 'you are not permissioned']);
        }
        return $this->apiResponse($posts, 401, 'Cannot Find To delete');
    }
}
