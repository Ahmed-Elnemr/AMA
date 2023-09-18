<?php

namespace App\Models;

use App\Models\BusinessInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactInformation extends Model
{
    use HasFactory;
    public $table = 'contact_information';
    protected $fillable = [
        'type',
        'value',
        'business_information_id',
        'user_id',
    ];
    public function businnesInfo()
    {
        return $this->belongsTo(BusinessInformation::class, 'business_information_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
