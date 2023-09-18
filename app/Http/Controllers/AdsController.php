<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;
use App\Models\User;
class AdsController extends Controller
{

    public function index(Request $request)
    {


        if($request->my == null){
            $data  = Ads::whereDate('end_date' , '>' , now()->format('Y-m-d H:i:s'))
            ->with('businessInfo')
            ->orderBy('view_count' , 'ASC')->limit(5)->get();


           foreach( $data as $x => $v  )
             {


                   $ad = Ads::where('id' ,  $v->id)->first();
                   $ad->view_count = $ad->view_count+1;
                   $ad->save();
            }
           return $data;
        }else{
            $authUser = User::find(\Auth::id());

            $data  = Ads::where('user_id', $authUser->id)
            ->with('businessInfo')
            ->orderBy('view_count' , 'ASC')->paginate(10);

            return $data;
        }


    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        //
    }


    public function show(Ads $ads)
    {
        //
    }


    public function edit(Ads $ads)
    {
        //
    }


    public function update(Request $request, Ads $ads)
    {
        //
    }


    public function destroy(Ads $ads)
    {
        //
    }
}
