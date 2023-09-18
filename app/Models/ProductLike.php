<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductLike extends Model
{
    use HasFactory;
    public $table = 'product_likes';
    protected $fillable = [
        'products_id',
        'user_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }

    
}
