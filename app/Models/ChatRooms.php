<?php

namespace App\Models;

use App\Models\User;
use App\Models\Media;
use App\Models\ChatRoomsLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatRooms extends Model
{
    use HasFactory;
    public $table = 'chat_rooms';
    protected $fillable = [
        'room_name',
        'room_is_private',
        'chat_key',
        'media_id',
        'owner_users_id',
    ];

    public function user()
    {

            return $this->hasOne(User::class, 'id' , 'owner_users_id' );
    }


    public function rlog()
    {
        return $this->hasMany(ChatRoomsLog::class, 'chat_room_id','id' )->with('user');
    }
    public function owner()
    {
        return $this->hasOne(User::class, 'id' , 'owner_users_id' );
    }
    public function media()
    {
        return $this->hasOne(Media::class,    'id' , 'media_id');
    }

}
