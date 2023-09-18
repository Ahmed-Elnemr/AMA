<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostComent;
use App\Models\CommentPost;
use Illuminate\Http\Request;

class CommentPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($postId)
    {
        //   $post=  Post::where('id', $postId)->first();
         $comments= PostComent::where('posts_id',$postId)->get();
           return view('admin.post-comments',compact('comments'));



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
// //
//     /**
//      * Display the specified resource.
//      *
//      * @param  \App\Models\CommentPost  $commentPost
//      * @return \Illuminate\Http\Response
//      */
//     public function show(CommentPost $commentPost)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  \App\Models\CommentPost  $commentPost
//      * @return \Illuminate\Http\Response
//      */
//     public function edit(CommentPost $commentPost)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \App\Models\CommentPost  $commentPost
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, CommentPost $commentPost)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  \App\Models\CommentPost  $commentPost
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy(CommentPost $commentPost)
//     {
//         //
//     }
}
