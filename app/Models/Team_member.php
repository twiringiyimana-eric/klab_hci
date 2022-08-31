<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team_member extends Model
{
    protected $fillable = [
        'name',
        'position',
        'image'
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
