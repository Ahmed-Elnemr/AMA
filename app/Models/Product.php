<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductLike;
use App\Models\ProductsHit;
use App\Models\SubCategory;
use App\Models\MainCategory;
use App\Models\OrdersDetails;
use App\Models\ProductReport;
use App\Models\ProductComment;
use App\Models\ProductsReview;
use App\Models\ProductSearchLog;
use App\Models\ProductsMediagroup;
use App\Models\BusinessInformation;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    public $table = 'products';
    protected $fillable = [
        'products_name',
        'products_price',
        'products_unite_name',
        'products_uinites',
        'is_featured',
        'users_id',
        'subcategories_id',
        'main_categories_id',
        'categories_id',
        'business_information_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategories_id', 'id');
    }
    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_categories_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
    public function businessInfo()
    {
        return $this->belongsTo(BusinessInformation::class, 'business_information_id', 'id');
    }
    public function Likes()
    {
        return $this->hasMany(ProductLike::class, 'products_id', 'id');
    }
    public function report()
    {
        return $this->hasMany(ProductReport::class, 'product_id', 'id');
    }

    public function orsdersDetails()
    {
        return $this->hasMany(OrdersDetails::class, 'product_id', 'id');
    }

    public function commentsProducts()
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'id');
    }

    public function hits()
    {
        return $this->hasMany(ProductsHit::class, 'product_id', 'id');
    }

    public function review()
    {
        return $this->hasMany(ProductsReview::class, 'product_id', 'id');
    }

    public function searchLog()
    {
        return $this->hasMany(ProductSearchLog::class, 'product_id', 'id');
    }
    // public function mediaGroup()
    // {
    //     return $this->hasMany(ProductsMediagroup::class, 'product_id', 'id');
    // }
    public function media()
    {
        return $this->belongsToMany(Media::class, 'products_mediagroups','product_id', 'media_id');
    }
}
