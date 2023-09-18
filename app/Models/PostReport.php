<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostReport extends Model
{
    use HasFactory;
    public $table = 'post_likes';
    protected $fillable =[
        'posts_id',
        'user_id',
        'reson',
        'status',
        'post_reportcol',

    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'posts_id', 'id');
    }
}
