<?php

namespace App\Models;

use App\Models\User;
use App\Models\Media;
use App\Models\BusinessInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

use App\Models\StoryHit;
use App\Models\StoryLike;

class Story extends Model
{
    use HasFactory;
    public $table = 'stories';
    protected $fillable = [
        'stories_start_date',
        'stories_end_date' ,
        'stories_type',
        'stories_captions',
        'stories_background',
        'media_id',
        'user_id',
        'business_information_id',
    ];



    public function hitStories($user_id, $id) {

        $StoryHit =  new StoryHit();
        $StoryHit->story_id =$id;
        $StoryHit->user_id = $user_id;
        return  $StoryHit->save();


        
    }

    public function like($user_id, $id)
    {
        if(self::isLiked($user_id, $id) == false)
        {
                $StoryLike = new StoryLike();
                $StoryLike->stories_id = $id;
                $StoryLike->users_id = $user_id;
                return $StoryLike->save();

        }else{
            return null;
        }

    }

    public function unlike($user_id, $id)
    {
        if(self::isLiked($user_id, $id) == true)
        {

            StoryLike::where('stories_id' , $id)->where('users_id' , $user_id)->destroy();
            return true;
        }else{
            return false;
        }

    }

    public function isLiked($user_id, $id){



        if(StoryLike::where('stories_id' , $id)->where('users_id' , $user_id)->get() != null)
        {

            return true ;
        }else{
            return false ;
        }


    }

    public function isViewd($user_id, $id){







         if(StoryHit::where('story_id' , $id)->where('user_id' , $user_id)->get() != null)
         {

            return true;
         }else{

            return false;
         }

    }
    public  function CreateFull(Request $request)
    {
        $authUser = User::find(\Auth::id());



        if($request->stories_type == "TEXT"){


            $Story = new Story();



            $Story->stories_start_date = "";
            $Story->stories_end_date = "";
            $Story->stories_type = $request->stories_type;
            $Story->stories_captions = $request->captions;
            $Story->stories_background = $request->background;
            //$Story->media_id = $r->id;
            $Story->user_id = $authUser->id;
            $Story->business_information_id = $request->business_information_id;

            $Story->save();
            return $Story;
        }else{

            $media  =  new Media();
            $r = $media->store($request);
            if($r != null)
                    {


                        $Story = new Story();



                        $Story->stories_start_date = "";
                        $Story->stories_end_date = "";
                        $Story->stories_type = $request->stories_type;
                        $Story->stories_captions = $request->captions;
                        $Story->stories_background = $request->background;
                        $Story->media_id = $r->id;
                        $Story->user_id = $authUser->id;
                        $Story->business_information_id = $request->business_information_id;
                        $Story->save();
                        return $Story;
                    }else{
                        return null;
                    }
        }




    }


    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id','id' );
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }
    public function businessInfo()
    {
        return $this->belongsTo(BusinessInformation::class, 'business_information_id','id' );
    }
    public function likes()
    {
        return $this->hasMany(StoryLike::class,'stories_id' ,'id'  );
    }
    public function hits()
    {
        return $this->hasMany(StoryHit::class, 'story_id', 'id'  );
    }


}
