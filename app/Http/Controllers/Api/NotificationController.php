<?php

namespace App\Http\Controllers\Api;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{

    public function index()
    {

        $authUser = User::find(Auth::id());
        return Notification::where('user_id' , $authUser->id )->orWhere('user_id' ,  null )->with('media')->orderBy('id' ,  'DESC')->paginate(10);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show(Notification $notification)
    {

    }


    public function edit(Notification $notification)
    {

    }


    public function update(Request $request, Notification $notification)
    {

    }


    public function destroy(Notification $notification)
    {

    }
}
