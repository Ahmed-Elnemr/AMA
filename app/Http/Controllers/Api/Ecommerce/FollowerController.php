<?php
namespace App\Http\Controllers\Api\Ecommerce;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
class FollowerController extends Controller
{
    public function index()
    {

    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $authUser = User::find(\Auth::id());
        $Follower = new Follower();

        $r =Follower::where('followers_users_id' ,$authUser->id )->where('followeing_users_id' , $request->id)->first();


        if($r == null) {

            $Follower->followers_users_id =   $authUser->id;
            $Follower->followeing_users_id = $request->id;
             $Follower->save();

        }else{

            Follower::destroy($r->id);
        }


    }


    public function show($id)
    {
        $authUser = User::find(\Auth::id());
         return Follower::where('followers_users_id' ,$authUser->id )->where('followeing_users_id' , $id)->first();

    }


    public function edit(Follower $follower)
    {

    }


    public function update(Request $request, Follower $follower)
    {

    }


    public function destroy(Follower $follower)
    {

    }
}
