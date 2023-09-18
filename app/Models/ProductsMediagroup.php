<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsMediagroup extends Model
{
    use HasFactory;
    public $table = 'products_mediagroups';
    protected $fillable = [
        'product_id',
        'media_id',
        'order',

    ];

    public function product()
    {
        return $this->belongsTo(Proudct::class, 'product_id', 'id');
    }
    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
}
