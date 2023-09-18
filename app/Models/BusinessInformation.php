<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Media;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Story;
use App\Models\Product;
use App\Models\Category;
use App\Models\UserLink;
use App\Models\Subscription;
use App\Models\Follower;
use App\Models\SubscriptionPkg;
use App\Models\UserReview;
use App\Models\VendorLocation;
use App\Models\ContactInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class BusinessInformation extends Model
{
    use HasFactory;
    public $table = 'business_information';
    protected $fillable =[
        'legal_name',
        'slug_name',
        'user_id',
        'cover_media_id',
        'logo_media_id',
        'categories_id',

    ];




    public function followe($user_id ,  $id)
    {

        $obj = self::isfollower($user_id ,  $id);
        if( $obj == false && $obj != null )
        {
            $follower = new Follower();
            $follower->followers_users_id = $user_id ;
            $follower->followeing_users_id = $id ;
            $follower->save();
        }



    }

    public function isfollower()
    {
        $user   = null ;
        if(\Auth::id() != null){
            $user   = User::find(\Auth::id());
        }


        if($user != null){
              return $this->hasOne(Follower::class, 'followeing_users_id','id' )->where('followers_users_id' , $user->id ) ;


        }else{
            return false;
        }




    }



    public function isInMyList()
    {

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }


    public function coverMedia()
    {
        return $this->belongsTo(Media::class, 'cover_media_id','id' );
    }

    public function logoMedia()
    {
        return $this->belongsTo(Media::class, 'logo_media_id','id' );
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id','id' )->with('i18n');
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'business_information_id','id' );
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'business_information_id','id' );
    }


    public function followeing(){

        return $this->hasMany(Follower::class, 'followeing_users_id','id' );
    }

    public function contactInfo()
    {
        return $this->hasMany(ContactInformation::class, 'business_information_id','id' );
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'business_information_id','id' );
    }


    public function stories()
    {
        return $this->hasMany(Story::class, 'business_information_id','id' );
    }


    public function Location(){

        return $this->hasMany(VendorLocation::class, 'business_information_id','id' );
    }

    public function Reviews(){

        return $this->hasMany(UserReview::class, 'for_users_id','id' );
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'business_information_id','id' );//->orderByDesc('id')
    }

    public function userLinks()
    {
        return $this->hasMany(UserLink::class, 'business_information_id','id' );
    }

    public function subscription()
    {
        return $this->hasMany(Subscription::class, 'business_information_id','id' );
    }


    public function personal()
    {
        return $this->hasOne(PersonalInformation::class, 'user_id','user_id' );
    }
}
