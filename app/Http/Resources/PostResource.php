<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'post body'=>$this->postBody,
            'user'=>$this->users->name,
            'photo'=>$this->photo,
            'video'=>$this->video,
            'likes'=>$this->likes,
            'comments'=>count($this->comments)

        ];
    }
}
