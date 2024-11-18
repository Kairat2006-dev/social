<?php

namespace App\Service;

use App\Models\PostImage;

class PostImageService
{
    public static function updatePostId(int $imageId, int $postId)
    {
        if(isset($imageId)) {
           $post = PostImage::find($imageId);
           $post->update(['post_id' => $postId,'status' => true]);
        }
    }
}
