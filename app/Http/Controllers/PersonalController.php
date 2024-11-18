<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\SubscriberFollowing;
use App\Models\User;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function show(User $user)
    {

        $posts = PostResource::collection(Post::all()->where('user_id',$user->id))->resolve();

        $user = UserResource::make($user);
        $following = SubscriberFollowing::where('subscriber_id',auth()->id())
            ->get('following_id')->pluck('following_id')->toArray();
            if(in_array($user->id,$following)){
                $user->following = true;
        }

        return inertia("Personal/Show", compact('posts', 'user'));
    }
    public function toogleFollowing(User $user){
        $res = auth()->user()->following()->toggle($user->id);
        $data['following'] = count($res['attached']) > 0;
        return $data;
    }
}
