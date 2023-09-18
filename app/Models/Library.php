<?php

namespace App\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Library extends Model
{
    use HasFactory;
    public $table = 'libraries';
    protected $fillable = [
        'librarys_title',
        'url',
        'media_id',

    ];
    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id','id' );
    }
}
