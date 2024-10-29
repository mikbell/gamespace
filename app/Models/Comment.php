<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['game_slug', 'content', 'author_name'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
