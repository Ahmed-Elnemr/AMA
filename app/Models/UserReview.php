<?php

namespace App\Models;

use App\Models\User;
use App\Models\BusinessInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserReview extends Model
{
    use HasFactory;
    public $table = 'user_reviews';
    protected $fillable=[
        'points',
        'users_review_text',
        'by_users_id',
        'for_users_id', //business information id
    ];
    public function byUser(){
        return $this->belongsTo(User::class, 'by_users_id','id' );

    }
    public function forUser(){
        return $this->belongsTo(BusinessInformation::class, 'for_users_id','id' );

    }
}
