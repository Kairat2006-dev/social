<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\LikedPost;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\SubscriberFollowing;
use App\Service\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = PostResource::collection(Post::all());
        $likedId = LikedPost::where('user_id', auth()->id())
            ->get('post_id')->pluck('post_id')->toArray();
        foreach ($posts as $post) {
            if (in_array($post['id'], $likedId)) {
                $post['liked'] = true;
            }
        }
        return inertia("Post/Index", compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        try {
            DB::beginTransaction();
            $data = $request->validationData();
            $post = PostService::store($data);
            DB::commit();
            return PostResource::make($post);
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 500);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = PostResource::make($post);
        $user = UserResource::make($post['users'])->resolve();
        $following = SubscriberFollowing::where('subscriber_id',auth()->id())
        ->get('following_id')->pluck('following_id')->toArray();
        if (in_array($user['id'], $following)) {
            $user['following'] = true;
        }
        return inertia("Post/Show", compact('post', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function toggleLiked(Post $post){
        $res = auth()->user()->postLike()->toggle($post);
        $data['liked'] = count($res['attached']) > 0;
        return $data;
    }
}
