<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserReport extends Model
{
    use HasFactory;
    public $table = 'user_reports';
    protected $fillable=[
        'reson',
        'status',
        'by_user_id',
        'for_user_id',
    ];

    public function byUser()
    {
        return $this->belongsTo(User::class, 'by_user_id','id' );
    }

    public function forUser()
    {
        return $this->belongsTo(User::class, 'for_user_id','id' );
    }



}
