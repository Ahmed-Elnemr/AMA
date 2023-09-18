<?php
namespace App\Http\Controllers\Api\Ecommerce;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
class CategoryController extends Controller
{

    public function index()
    {



        return Category::
          with('media')
        ->with('i18n')
        ->distinct()
        ->paginate(25);
    }





    public function show($id)
    {



       return Category::
       where('main_categories_id' , $id)
       ->with('media')
       ->with('i18n')
       ->distinct()
       ->paginate(25);

    }




}
