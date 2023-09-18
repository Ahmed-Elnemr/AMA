<?php

namespace App\Models;

use App\Models\Media;
use App\Models\BusinessInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TopRanked extends Model
{
    use HasFactory;
    public $table = 'top_rankeds';
    protected $fillable =[
        'user_id',
        'media_id',
        'businessinfo_id',

    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id','id' );
    }
    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id','id' );
    }
    public function logoMedia()
    {
        return $this->belongsTo(Media::class, 'media_id','id' );
    }
    public function businessInfo()
    {
        $user   = null ;
        if(\Auth::id() != null){
            $user   = User::find(\Auth::id());
        }
        if($user != null)
        {
            return $this
            ->hasOne(BusinessInformation::class, 'id' , 'businessinfo_id' )
            ->with('coverMedia')
            ->with('Location')
            ->with('logoMedia')
            ->with('contactInfo')
            ->with('category')
            ->with('isfollower')
            ->with('personal')
            ->withCount(['followeing']);
        }else{

            return $this
            ->hasOne(BusinessInformation::class, 'id' , 'businessinfo_id' )
            ->with('coverMedia')
            ->with('Location')
            ->with('logoMedia')
            ->with('contactInfo')
            ->with('category')
         //   ->with('isfollower')
            ->with('personal')
            ->withCount(['followeing']);
        }

    }

}
