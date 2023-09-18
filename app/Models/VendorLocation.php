<?php

namespace App\Models;

use App\Models\BusinessInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorLocation extends Model
{
    use HasFactory;
    public $table = 'vendor_locations';
    protected $fillable=[
        'country',
        'city',
        'street',
        'landmark',
        'building',
        'floor',
        'flat',
        'business_information_id',
    ];
    public function businnessInfo(){
        return $this->belongsTo(BusinessInformation::class, 'business_information_id','id' );

    }
}
