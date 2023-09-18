<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductComment extends Model
{
    use HasFactory;
    public $table = 'product_comments';
    protected $fillable = [
        'comments_data',
        'product_id',
        'user_id',

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'products_id','id' );
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id','id' );
    }
}
