<?php

namespace App\Models;

use App\Models\User;
use App\Models\Story;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoryLike extends Model
{
    use HasFactory;
    public $table = 'story_likes';
    protected $fillable =[
        'stories_likes_reaction_type',
        'stories_id',
        'users_id',

    ];

    public function story()
    {
        return $this->belongsTo(Story::class, 'stories_id','id' );
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id','id' );
    }
    

}
