<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;
    public $table = 'personal_information';
    protected $fillable =[
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'phone',
        'bio',

    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }

}
