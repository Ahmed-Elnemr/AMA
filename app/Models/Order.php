<?php

namespace App\Models;

use App\Models\User;
use App\Models\Address;
use App\Models\OrdersDetails;
use App\Models\BusinessInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    public $table = 'orders';
    protected $fillable =[
        'status',
        'total',
        'user_id',
        'business_information_id',
        'address_id',
        'orderscol',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }

    public function orders()
    {
        return $this->hasMany(OrdersDetails::class,  'orders_id' , 'id' )->with('product');
    }

    public function businessInfo()
    {
        return $this->belongsTo(BusinessInformation::class, 'business_information_id','id' );
    }
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id','id' );
    }


}
