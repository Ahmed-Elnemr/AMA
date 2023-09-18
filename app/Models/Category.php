<?php

namespace App\Models;

use App\Models\Media;
use App\Models\Product;
use App\Models\i18nRepo;
use App\Models\SubCategory;
use App\Models\MainCategory;
use App\Models\BusinessInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    public $table = 'categories';
    protected $fillable =[
        'categories_title',
        'categories_body',
        'media_id',
        'main_categories_id'
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id','id' );
    }
    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_categories_id','id' );
    }


    public function i18n(){
        return $this->hasMany(i18nRepo::class ,    'i18n_refrance_id' , 'id')->where('i18n_class_name' , 'Category');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'categories_id','id' );
    }

    public function businessInfo()
    {
        return $this->hasMany(BusinessInformation::class, 'categories_id','id' );
    }

}
