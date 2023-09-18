<?php

namespace App\Models;

use App\Models\User;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    public $table = 'questions';
    protected $fillable = [
        'the_questions',
        'questionscol',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id','id' )->with('user')->with('comment')->orderBy('id', 'DESC')->limit(10);
    }
}
