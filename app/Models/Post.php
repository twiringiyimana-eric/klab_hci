<?php

namespace App\Models;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
       'user_id'
    ];

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Likes()
    {
        return $this->hasMany(like::class);
    }
}
