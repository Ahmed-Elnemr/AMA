<?php

namespace App\Http\Controllers\Api\Ecommerce;

use App\Models\PostLike;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
class PostLikeController extends Controller
{

    public function index()
    {

    }


    public function create()
    {

    }


    public function store(Request $request)
    {

            $user =  User::find(\Auth::id());
            $isInMyLike = PostLike::Where('user_id', $user->id)->where('posts_id' , $request->posts_id )->first();

            if($isInMyLike == null){


                $PostLike = new PostLike();
                $PostLike->user_id = $user->id;
                $PostLike->posts_id = $request->posts_id;

                $PostLike->save();

                return $PostLike;


            }else{
                PostLike::destroy($isInMyLike->id);
            }


    }


    public function show($id)
    {

    }


    public function edit(PostLike $postLike)
    {

    }


    public function update(Request $request, PostLike $postLike)
    {

    }


    public function destroy(PostLike $postLike)
    {

    }
}
