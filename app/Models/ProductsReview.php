<?php

namespace App\Models;

use App\Models\Media;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductsReview extends Model
{
    use HasFactory;
    public $table = 'products_reviews';
    protected $fillable = [
        'review_points',
        'products_review_text',
        'product_id',
        'user_id',
        'media_id', //no crude 
    ];
    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
