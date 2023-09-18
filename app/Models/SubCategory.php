<?php

namespace App\Models;

use App\Models\Media;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;
    public $table = 'sub_categories';
    protected $fillable = [
        'subcategories_title',
        'subcategories_body',
        'media_id',
        'category_id'
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }


    public function i18n()
    {
        return $this->hasMany(i18nRepo::class,    'i18n_refrance_id', 'id')->where('i18n_class_name', 'SubCategory');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,    'category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,    'subcategories_id', 'id');
    }
}
