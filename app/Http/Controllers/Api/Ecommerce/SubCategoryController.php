<?php

namespace App\Http\Controllers\Api\Ecommerce;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class SubCategoryController extends Controller
{

    public function index()
    {



        return SubCategory::
          with('media')
        ->with('i18n')
        ->distinct()
        ->paginate(25);
    }





    public function show($id)
    {

        return SubCategory::
            where('category_id' ,  $id)
            ->with('media')
            ->with('i18n')
            ->distinct()
            ->paginate(25);

    }




}
