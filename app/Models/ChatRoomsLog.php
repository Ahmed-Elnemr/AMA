<?php

namespace App\Models;

use App\Models\User;
use App\Models\ChatRooms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatRoomsLog extends Model
{
    use HasFactory;
    public $table = 'chat_rooms_logs';
    protected $fillable = [
        'chat_room_id',
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id','user_id' );
    }

    public function chatRoms()
    {
        return $this->belongsTo(ChatRooms::class, 'chat_room_id', 'id');
    }
}
