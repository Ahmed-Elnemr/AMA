<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryHit extends Model
{
    use HasFactory;
    public $table = 'story_hits';
    protected $fillable =[
        'story_id',
        'user_id',
        

    ];

    public function story()
    {
        return $this->belongsTo(Media::class, 'story_id','id' );
    }
    public function user()
    {
        return $this->belongsTo(Media::class, 'user_id','id' );
    }

}
