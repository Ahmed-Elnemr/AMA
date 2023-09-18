<?php

namespace App\Http\Controllers\Api;

use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;

class MediaController extends Controller
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

        if ($authUser != null) {


                if ($request->hasFile('images')) {
                    //$file = $request->file('images');

                    $destinationPath = storage_path("app/public/website/$authUser->id/");

                    $myimage =  time().'.'.$request->images->getClientOriginalName();
                    $complet_path = url('/')."/storage/website/$authUser->id/" . $myimage;
                    $request->images->move($destinationPath, $myimage);


                    $VendorsGallery = new Media();
                   // $mime = $request->images->getMimeType();

                    $VendorsGallery->user_id =  $authUser->id;
                    $VendorsGallery->path  = $complet_path;
                 //if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv")
                   //    {
                           $VendorsGallery->media_type = "VIDEO";
                     //   }else
                    // {
                            $VendorsGallery->media_type = "IMAGE";

                      //  }

                    $VendorsGallery->save();


                    return response()->json([
                        "message" => "done" ,
                        "body" => $VendorsGallery,
                    ], 200 );

                }else{
                    return response()->json([
                        "message" => "error in file" ,

                    ], 400 );
                }





            }else{
                return response()->json([
                    "message" => "error in ruls" ,

                ], 400 );
            }



    }


    public function show(Media $media)
    {

    }


    public function edit(Media $media)
    {

    }


    public function update(Request $request, Media $media)
    {

    }


    public function destroy(Media $media)
    {
    }
}
