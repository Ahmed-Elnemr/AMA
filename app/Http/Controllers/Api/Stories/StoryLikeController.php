<?php

namespace App\Http\Controllers\Api\Stories;

use App\Models\StoryLike;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;



/**
 *
 *
 * this black api
 *
 *
 */

class StoryLikeController extends Controller
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
        $storyLike = new StoryLike();
        $storyLike->stories_likes_reaction_type = "like" ;
        $storyLike->stories_id = $request->sid;
        $storyLike->users_id =$authUser->id;
        $storyLike->save();

        return $storyLike;

    }


    public function show(StoryLike $storyLike)
    {

    }


    public function edit(StoryLike $storyLike)
    {

    }


    public function update(Request $request, StoryLike $storyLike)
    {

    }


    public function destroy(StoryLike $storyLike)
    {

    }
}
