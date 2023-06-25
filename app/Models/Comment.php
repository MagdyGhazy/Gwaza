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
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'userId');
    }

}
