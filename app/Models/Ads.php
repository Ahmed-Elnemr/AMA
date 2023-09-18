<?php

namespace App\Models;

use App\Models\BusinessInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ads extends Model
{
    use HasFactory;
    public $table = 'ads';
    protected $fillable = [
        'user_id',
        'business_profile_id',
        'start_date',
        'end_date',
        'view_count',
        'fund_source',
        'fund_amount',
        'day_price',
        'view_price',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }

    public function businessInfo()
    {
        return $this->belongsTo(BusinessInformation::class, 'business_profile_id','id' )
        ->with('coverMedia')
        ->with('Location')
        ->with('logoMedia')
        ->with('contactInfo')
        ->with('category')

        ->with('isfollower')
        ->with('personal')
        ->withCount(['followeing'])
        ->withCount(['Reviews', 'followeing'])
        ;
    }
}
