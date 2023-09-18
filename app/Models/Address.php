<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;
    public $table = 'addresses';
    protected $fillable = [
        'country',
        'city',
        'street',
        'landmark',
        'building',
        'floor',
        'flat',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'address_id','id' );
    }
}
