<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductReport extends Model
{
    use HasFactory;
    public $table = 'product_reports';
    protected $fillable = [
        'reson',
        'status',
        'product_id',
        'user_id',

    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id','id' );
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }


}
