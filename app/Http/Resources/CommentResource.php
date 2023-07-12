<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'comment body'=>$this->commentBody,
            'user'=>$this->users->name,
            'post'=>$this->Posts->id,
            'parent_Comment'=>$this->parentCommentId,
            'photo'=>$this->photo,
            'video'=>$this->video,
            'is_liked'=>count($this->likes->where('user_id',auth()->guard('api')->user()->id)) == 1 ? true : false,
            'likes'=>$this->likes,
            'likesCount'=>$this->likeCount,
            'replies'=>$this->Posts->comments->where('parentCommentId',$this->id)
        ];
    }
}
