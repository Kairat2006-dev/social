<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PostImage extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'post_images';
    public function getUrlAttribute(){
        return url('storage/'.$this->patch);
    }
}
