<?php

namespace App\Http\Controllers\Api\Ecommerce;
use App\Models\User;
use App\Models\UserReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
class UserReviewController extends Controller
{

    public function index(Request $request)
    {
        return UserReview::where('for_users_id' , $request->id  )->with('byUser')->orderBy('id', 'DESC')->paginate(10);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $authUser = User::find(\Auth::id());
        $userReview = new UserReview();

        $userReview->points = 5 ; //$request->points ;
        $userReview->users_review_text = $request->users_review_text ;
        $userReview->by_users_id = $authUser->id ;
        $userReview->for_users_id = $request->for_users_id ;
        $userReview->save();
        return  UserReview::where('id' , $userReview->id  )->with('byUser')->first();

    }


    public function show(UserReview $userReview)
    {

    }


    public function edit(UserReview $userReview)
    {

    }


    public function update(Request $request, UserReview $userReview)
    {
    }


    public function destroy(UserReview $userReview)
    {

    }
}
