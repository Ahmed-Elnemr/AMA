<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Answer;
use App\Models\BusinessInformation;
use App\Models\ContactInformation;
use App\Models\Follower;
use App\Models\PersonalInformation;
use App\Models\Post;
use App\Models\Product;
use App\Models\Question;
use App\Models\Subscription;
use App\Models\SubscriptionPkg;

class UserDetailsWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $user= User::where('id', $id)->first();
        $businessInfo=BusinessInformation::where('user_id',$id)->first();
        $followers=Follower::where('followers_users_id',$id)->get()->count();
        $followeing=Follower::where('followeing_users_id',$id)->get()->count();
        $posts=Post::where('user_id',$id)->get()->count();
        $products=Product::where('users_id',$id)->get()->count();
        $questions=Question::where('user_id',$id)->get()->count();
        $answers=Answer::where('user_id',$id)->get()->count();
        $contacts=ContactInformation::where('user_id',$id)->get();
        $personalInfo=PersonalInformation::where('user_id',$id)->select('bio')->first();
        $address=Address::where('user_id',$id)->get();
        //subscription pkg
        $subscriptions=Subscription::where('user_id',$id)->get();

// dd($subPkgId);


       return view('admin.user-details', compact('user','businessInfo','followers','followeing','posts','products'
        ,'questions',
        'answers',
        'contacts',
        'personalInfo',
        'address',
        'subscriptions'


    ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
