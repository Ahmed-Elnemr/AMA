<?php

namespace App\Models;

use App\Models\User;
use App\Models\StoryHit;
use App\Models\BusinessInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLink extends Model
{
    use HasFactory;
    public $table = 'user_links';
    protected $fillable =[
        'slug',
        'value',
        'user_id',
        'business_information_id',


    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }
    public function businessInfo()
    {
        return $this->belongsTo(BusinessInformation::class, 'business_information_id','id' );
    }

    }
