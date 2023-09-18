<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnswersVote extends Model
{
    use HasFactory;
    public $table = 'answers_votes';
    protected $fillable = [
        'answers_id',
        'vote_value',
        'user_id',
    ];
    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answers_id','id' );
    }

    public function vote()
    {
        return $this->belongsTo(User::class, 'vote_value','id' );
    }

}
