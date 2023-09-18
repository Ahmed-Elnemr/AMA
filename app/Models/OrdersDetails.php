<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdersDetails extends Model
{
    use HasFactory;
    public $table = 'orders_details';
    protected $fillable = [
        'orders_id',
        'product_id',
        'quantity',
        'total_price',
        'item_price'

    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id','id' );
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id','id' )->with('media');
    }
}
