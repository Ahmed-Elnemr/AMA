<?php

namespace App\Http\Controllers\Api\Ecommerce;

use App\Models\Post;
use App\Models\User;
use App\Models\Media;
use App\Models\PostLike;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
class PostController extends Controller
{

    public function index(Request $request)
    {
        return Post::where('business_information_id' ,$request->id )->with('media')->with('businessInfo')->with('isMylike')->withCount(['comments' , 'likes'])->orderBy('id' , 'DESC')->paginate(10);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
             $authUser = User::find(\Auth::id());

             $VendorsGallery = new Media();
             if ($request->hasFile('images')) {





                $destinationPath = storage_path("app/public/website/$authUser->id/");

                $myimage =  time().'.'.$request->images->getClientOriginalName();
                $complet_path = url('/')."/storage/website/$authUser->id/" . $myimage;
                $request->images->move($destinationPath, $myimage);



                $VendorsGallery->user_id =  $authUser->id;
                $VendorsGallery->path  = $complet_path;
                $VendorsGallery->media_type = $request->type;



                $VendorsGallery->save();




            }else{
                $VendorsGallery = null;
            }

             $Post = new Post();
             $Post->post_playload = $request->post_playload;
             $Post->business_information_id = $request->business_information_id;
             $Post->user_id = $authUser->id;
             if($VendorsGallery != null)
             {
                 $Post->media_id = $VendorsGallery->id;

             }

            return  $Post->save();



    }


    public function show(Post $post)
    {

    }


    public function edit(Post $post)
    {

    }


    public function update(Request $request, Post $post)
    {

    }


    public function destroy($id)
    {
        $authUser = User::find(\Auth::id());

        PostLike::where('posts_id' , $id)->delete();
        $story =  Post::where('user_id' , $authUser->id)->where('id' ,  $id)->first()->delete();
        return $story;
    }
}
