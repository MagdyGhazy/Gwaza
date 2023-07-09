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
            'post'=>$this->comments->id,
            'photo'=>$this->photo,
            'video'=>$this->video,
            'likes'=>$this->likes,
        ];
    }
}
