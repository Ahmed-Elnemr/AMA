<?php

namespace App\Models;

use App\Models\User;
use App\Models\Question;
use App\Models\AnswersVote;
use App\Models\AnswersComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;
    public $table = 'answers';
    protected $fillable = [
        'answers_text',
        'question_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id','id' );
    }
    public function comment()
    {
        return $this->hasMany(AnswersComment::class,'answers_id','id')->with('user')->limit(10);
    }
    public function vote()
    {
        return $this->hasMany(AnswersVote::class, 'answers_id','id' )->with('user');
    }
}
