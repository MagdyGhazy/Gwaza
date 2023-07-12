<?php

namespace App\Models;

use Conner\Likeable\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory,Likeable;
    protected $fillable = [
        'userId',
        'postBody',
        'photo',
        'video',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'postId');
    }

}

