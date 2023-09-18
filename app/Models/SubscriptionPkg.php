<?php

namespace App\Models;

use App\Models\Category;
use App\Models\MainCategory;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionPkg extends Model
{
    use HasFactory;
    public $table = 'subscription_pkgs';
    protected $fillable =[
        'pkg_name',
        'main_categories_id',

    ];

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_categories_id','id' );
    }
    public function subscription()
    {
        return $this->hasMany(Subscription::class, 'main_categories_id','id' );
    }
}
