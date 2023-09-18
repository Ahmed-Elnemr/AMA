<?php

namespace App\Models;

use App\Models\User;
use App\Models\Media;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    public $table = 'offers';
    protected $fillable = [
        'offers_discount',
        'offers_start',
        'offers_end',
        'offers_title',
        'offers_code',
        'offers_limits',
        'business_information_id',
        'media_id',
        'user_id',
    ];
    public function businessInfo()
    {
        return $this->belongsTo(BusinessInformation::class, 'business_information_id','id' );
    }
    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id','id' );
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }
    public function vouchers()
    {
        return $this->hasMany(Voucher::class, 'offer_id','id' );
    }
}
