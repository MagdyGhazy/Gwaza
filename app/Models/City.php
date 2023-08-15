<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable =['name','governorate_id'];
    public function cities(){
        return $this->belongsTo(Governorate::class,'governorate_id');
    }
}
