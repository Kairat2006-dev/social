<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostImages\PostImagesRequest;
use App\Http\Resources\PostImage\PostImageResource;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostImagesController extends Controller
{
    public function store(PostImagesRequest $request){
        $path = Storage::disk('public')->putFile('images', $request['image']);
        $image =  PostImage::create([
            'patch' => $path,
            'user_id' => auth()->id(),
        ]);
        return PostImageResource::make($image);
    }
}
