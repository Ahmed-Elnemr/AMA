<?php

namespace App\Http\Controllers\Api;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function index()
    {       $authUser = User::find(\Auth::id());
            return Subscription::where('user_id' ,   $authUser->id )->with('subscriptionPkg')->with('user')->with('businessInfo')->paginate(10);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show(Subscription $subscription)
    {

    }


    public function edit(Subscription $subscription)
    {

    }


    public function update(Request $request, Subscription $subscription)
    {

    }


    public function destroy(Subscription $subscription)
    {

    }
}
