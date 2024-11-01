<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = ['game_slug', 'content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
