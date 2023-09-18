<?php

namespace App\Models;

use App\Models\User;
use App\Models\SubscriptionPkg;
use App\Models\BusinessInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;
    public $table = 'subscriptions';
    protected $fillable =[
        'subscription_start',
        'subscription_end',
        'duration_in_days',
        'subscription_pkg_id',
        'user_id',
        'business_information_id',

    ];

    public function subscriptionPkg()
    {
        return $this->belongsTo(SubscriptionPkg::class, 'subscription_pkg_id','id' );
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id' , 'user_id' );
    }
    public function businessInfo()
    {
        return $this->belongsTo(BusinessInformation::class, 'business_information_id','id' )->with('coverMedia')
        ->with('Location')
        ->with('logoMedia')
        ->with('contactInfo')
        ->with('category')
        ->with('isfollower')
        ->with('personal')
        ->withCount(['followeing']);
    }
}
