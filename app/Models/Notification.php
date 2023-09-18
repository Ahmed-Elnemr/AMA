<?php

namespace App\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;
    public $table = 'notifications';
    protected $fillable = [
        'title',
        'massages',
        'user_id',
        'media_id',
    ];
    public function media()
    {
        return $this->hasOne(Media::class, 'id' , 'media_id' );
    }
    public function user()
    {
        return $this->hasOne(User::class, 'user_id','id' );
    }


    public static function sendNotification($input )
    {
        $firebaseToken = User::whereNotNull('fbtoken')->pluck('fbtoken')->all();

        $SERVER_API_KEY = 'AAAAz_CR3z4:APA91bHJljMQ-mDahtncI-AXmfSmJEJSwqnexgZ2RodNddWSkdHuhuMdrRvUMJyDnQnHiPgymF3qbs_2iGjXnhhQ5Bf-SbbypS2uPZqmVwNNUciCP04QxTScZWzyCnl3FJNx2SPMndTp';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $input["title"],
                "body" => $input['massages'],
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
      
       // dd($response);
    }
}
