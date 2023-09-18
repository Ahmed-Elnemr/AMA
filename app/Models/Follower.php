<?php

namespace App\Models;

use App\Models\User;
use App\Models\BusinessInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follower extends Model
{
    use HasFactory;
    public $table = 'followers';
    protected $fillable = [
        'followers_users_id',
        'followeing_users_id',
    ];
    public function followers()
    {
        return $this->belongsTo(User::class, 'followers_users_id', 'id');
    }
    public function followeing()
    {
        return $this->belongsTo(BusinessInformation::class, 'followeing_users_id', 'id');
    }
}
