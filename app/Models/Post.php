<?php

namespace App\Models;

use App\Models\User;
use App\Models\Media;
use App\Models\PostLike;
use App\Models\PostComent;
use App\Models\PostReport;
use App\Models\BusinessInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    public $table = 'posts';
    protected $fillable =[
        'post_playload',
        'media_id',
        'business_information_id',
        'user_id',

    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id','id' );
    }
    public function businessInfo()
    {
        return $this->belongsTo(BusinessInformation::class, 'business_information_id','id' )  ->with('coverMedia')
        ->with('Location')
        ->with('logoMedia')
        ->with('contactInfo')
        ->with('category')

        ->with('personal')
        ->withCount(['followeing']);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }

    public function comments()
    {
        return $this->hasMany(PostComent::class, 'posts_id','id' );
    }

    public function isMylike(){

        $user =  $authUser = User::find(\Auth::id());

        return $this->hasOne(PostLike::class, 'posts_id','id' )->where('user_id' , $user->id ) ;

    }
    public function likes()
    {
        return $this->hasMany(PostLike::class, 'posts_id','id' );
    }

    public function report()
    {
        return $this->hasMany(PostReport::class, 'posts_id','id' );
    }
}
