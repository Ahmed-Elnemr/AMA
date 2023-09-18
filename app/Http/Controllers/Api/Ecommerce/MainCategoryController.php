<?php
namespace App\Http\Controllers\Api\Ecommerce;

use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
class MainCategoryController extends Controller
{

    public function index()
    {




        return MainCategory::
          with('media')
         ->with('i18n')
         ->distinct()
         ->paginate(25);
    }






    public function show(MainCategory $mainCategory)
    {

    }





}
