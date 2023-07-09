<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Traits\ApiResponseTrait;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use ApiResponseTrait;
    use UploadImage;

    public function index()
    {
        $comments = CommentResource::collection(Comment::get());
        if ($comments) {
            return $this->apiResponse($comments, 200, 'done');
        } else {
            return $this->apiResponse(null, 404, 'there are no comments');
        }
    }

    public function store(Request $request)
    {

        if ($request->photo == null) {
            $imgPath = null;
        } else {
            $imgPath = $this->uploadImage($request, 'Comments/img');
        }

        if ($request->video == null) {
            $vidPath = null;
        } else {
            $vidPath = $this->uploadVedio($request, 'Comments/vid');
        }
        $comments = Comment::create([
            'commentBody' => $request->commentBody,
            'userId' => auth()->guard('api')->user()->id,
            'postId' => $request->postId,
            'photo' => $imgPath,
            'video' => $vidPath,
        ]);
        if ($comments) {
            return $this->apiResponse(new CommentResource($comments), 201, 'Add Success');
        }
        return $this->apiResponse(null, 404, 'Cannot Add comments');
    }

    public function update(Request $request,$id){

        $comments = Comment::findorfail($id);
        if ($comments->userId == auth()->guard('api')->user()->id) {
            if ($request->photo == "") {
                $imgPath = $comments->photo;
            } else {
                $imgPath = $this->uploadImage($request, 'Comments/img');
            }
            if ($request->vedio == "") {
                $vidPath = $comments->vedio;
            } else {
                $vidPath = $this->uploadVedio($request, 'Comments/vid');
            }
            $comments->update([
                'commentBody' => $request->commentBody,
                'userId' => auth()->guard('api')->user()->id,
                'postId' => $comments->postId,
                'photo' => $imgPath,
                'video' => $vidPath,

            ]);
            if ($comments) {
                return $this->apiResponse(new CommentResource($comments), 201, 'Ubdate Success');
            }
            return $this->apiResponse(null, 404, 'Cannot Ubdate comment');
        }
        return response()->json(['message' => 'you are not permissioned']);
    }

    public function destroy($id){
        $comments = Comment::find($id);
        if ($comments){
            $comments->delete();
            return $this->apiResponse(null,200,'comment has been deleted');
        }
        return $this->apiResponse($comments,401,'Cannot Find To delete');

    }
    public function customDestroy($id)
    {
        $comments = Comment::find($id);
        if ($comments) {
            if ($comments->userId == auth()->guard('api')->user()->id) {
                $comments->delete();
                return $this->apiResponse(null, 200, 'Post has been deleted');
            }
            return response()->json(['message' => 'you are not permissioned']);
        }
        return $this->apiResponse($comments, 401, 'Cannot Find To delete');
    }
}
