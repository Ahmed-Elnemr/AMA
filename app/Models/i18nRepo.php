<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class i18nRepo extends Model
{
    use HasFactory;

    public $table = 'i18n_repos';
    protected $fillable = [
        'i18n_class_name',
        'i18n_data',
        'i18n_refrance_id',
        'i18n_lang_iso' 
    ];

}
