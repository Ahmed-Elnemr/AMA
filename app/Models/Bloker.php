<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bloker extends Model
{
    use HasFactory;
    public $table = 'blokers';
    protected $fillable =[
        'user_id',
        'to_block_user_id',
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }
    public function blockUser()
    {
        return $this->belongsTo(User::class, 'to_block_user_id','id' );
    }
}
