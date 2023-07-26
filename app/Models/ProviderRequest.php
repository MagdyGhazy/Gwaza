<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_number',
        'id_photo_front',
        'id_photo_back',
        'criminal_fish',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
