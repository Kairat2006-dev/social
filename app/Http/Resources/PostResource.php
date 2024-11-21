<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title' => $this->title,
            'content' => $this->content,
            'image_url' => $this->image->url ?? '',
            'user' => $this->user_id,
            'user_name' => $this->users->name ?? '',
            'users'=>$this->users ?? '',
            'liked' => $this->liked ?? false,
            'liked_col'=> count($this->likedPost) ?? 0,
        ];
    }
}
