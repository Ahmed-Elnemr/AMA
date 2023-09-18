<?php

namespace App\Models;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnswersComment extends Model
{
    use HasFactory;
    public $table = 'answers_comments';
    protected $fillable = [
        'answers_comments_playload',
        'answers_commentscol',
        'answers_id',
        'user_id',
    ];

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answers_id','id' );
    }
    public function user()
    {
        return $this->belongsTo(Answer::class, 'user_id','id' );
    }

}
