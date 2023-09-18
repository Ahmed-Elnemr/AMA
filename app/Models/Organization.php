<?php

namespace App\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;
    public $table = 'organizations';
    protected $fillable = [
        'organizations_name',
        'organizations_txt_body',
        'organizations_phone',
        'url',
        'organizations_bank_account',
        'media_id'


    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id','id' );
    }
}
