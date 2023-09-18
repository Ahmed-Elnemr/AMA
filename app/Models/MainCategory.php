<?php

namespace App\Models;

use App\Models\Media;
use App\Models\Product;
use App\Models\Category;
use App\Models\i18nRepo;
use App\Models\SubscriptionPkg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainCategory extends Model
{
    use HasFactory;
    public $table = 'main_categories';
    protected $fillable =[
        'main_categories_title',
        'main_categories_body',
        'media_id',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id','id' );
    }

    public function i18n(){
        return $this->hasMany(i18nRepo::class ,    'i18n_refrance_id' , 'id')->where('i18n_class_name' , 'MainCategory');
    }
    public function category(){
        return $this->hasMany(Category::class ,    'main_category_id' , 'id');
    }
    public function subscriptionPkg(){
        return $this->hasMany(SubscriptionPkg::class ,    'main_categories_id' , 'id');
    }

    public function products(){
        return $this->hasMany(Product::class ,    'main_categories_id' , 'id');
    }
}
