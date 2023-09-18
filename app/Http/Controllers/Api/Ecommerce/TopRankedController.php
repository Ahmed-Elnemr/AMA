<?php

namespace App\Http\Controllers\Api\Ecommerce;
use App\Models\TopRanked;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
class TopRankedController extends Controller
{

    public function index()
    {


        return TopRanked::with('businessInfo')->orderBy('id' , 'DESC')->paginate(10);


    }





    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {


    }



}
