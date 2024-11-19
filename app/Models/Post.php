<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'posts';
    protected $with = ['image'];

    public function image()
    {
        return $this->hasOne(PostImage::class, 'post_id', 'id')
            ->whereNotNull('post_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function clearStorage()
    {
        $images = PostImage::where('post_id',null)
        ->get();
        foreach ($images as $image) {
            Storage::disk('public')->delete($image->patch);
            $image->delete();
        }
    }
}
