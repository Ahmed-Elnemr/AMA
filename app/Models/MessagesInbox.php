<?php

namespace App\Models;

use App\Models\User;
use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MessagesInbox extends Model
{
    use HasFactory;

    public $table = 'messages_inboxes';
    protected $fillable = [
        'messages_headers',
        'messages_playload',
        'from_users_id',
        'to_users_id',
        'messages_dailog',
        'media_id',
    ];
    public function media()
    {
        return $this->hasOne(Media::class, 'media_id','id' );
    }
    public function fromUser()
    {
        return $this->hasOne(User::class, 'from_users_id','id' );
    }
    public function tomUser()
    {
        return $this->hasOne(User::class, 'to_users_id','id' );
    }
}
