<?php

namespace App\Service;

use App\Models\Post;

class PostService
{
    public static function store(array $data,): Post{
        $imageId = $data['image_id'];
        unset($data['image_id']);

        $post = Post::create($data);
        $postId = $post->id;
        PostImageService::updatePostId($imageId, $postId);
        return $post;
    }
}
