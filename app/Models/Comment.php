<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'postId',
        'userId',
        'commentBody',
        'likes',
        'photo',
        'video',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    public function comments()
    {
        return $this->belongsTo(Post::class,'postId');
    }

}
