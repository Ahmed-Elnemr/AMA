<?php

namespace App\Http\Controllers\Api\Stories;

use App\Models\User;
use App\Models\Story;
use App\Models\Media;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Carbon\Carbon;
class StoryController extends Controller
{

    public function index(Request $request)
    {
        $authUser = User::find(\Auth::id());

        if($authUser->role_id == "VENDOR"){
            return Story::where('user_id' ,  $authUser->id)->orderBy('id' , "DESC")->with('user')->with('media')->withCount(['hits', 'likes'])->paginate(5);

        }else{
                   if($request->getall == 1)
                    {
                        $current_timestamp = Carbon::now();
                        return Story::where('stories_type' ,'!=',  'VIDEO')->whereDate('stories_end_date' , '>' , now()->format('Y-m-d H:i:s'))->orderBy('id' , "DESC")->with('user')->with('media')->withCount(['hits', 'likes'])->paginate(5);

                    }else{
                        $current_timestamp = Carbon::now();
                        return Story::where('stories_type' ,  'VIDEO')->whereDate('stories_end_date' , '>' , now()->format('Y-m-d H:i:s'))->orderBy('id' , "DESC")->with('user')->with('media')->withCount(['hits', 'likes'])->paginate(5);

                    }
        }


    }




    public function store(Request $request)
    {
        $authUser = User::find(\Auth::id());

        $VendorsGallery = new Media();

        if ($authUser != null) {


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

            }





        }else{

        }

        $story =  new Story();

         $story->stories_start_date = Carbon::now();

         $story->stories_end_date = Carbon::now()->addDays(1);
         $story->stories_type = $request->type;

         $story->stories_captions = $authUser->name;// $request->stories_captions;

         $story->stories_background = "0xFFFFFFF"; //$request->stories_background;
         $story->media_id = $VendorsGallery->id;
         $story->user_id = $authUser->id;
         //$story->business_information_id = "";
         $story->save();

        return $story;
    }




    public function show($id)
    {

        $authUser = User::find(\Auth::id());


        $story = new Story();

        $story->hitStories($authUser->id ,  $id);

        return Story::where('id' , $id)->with('user')->with('media')->withCount(['hits', 'likes'])->get();

    }




    public function like($id)
    {
        $authUser = User::find(\Auth::id());


        $story = new Story();

       return $story->like($authUser->id ,  $id);

    }


    public function unlike($id)
    {
        $authUser = User::find(\Auth::id());


        $story = new Story();

       return $story->unlike($authUser->id ,  $id);

    }





    public function destroy($id)
    {

            $authUser = User::find(\Auth::id());
            $story =  Story::where('user_id' , $authUser->id)->where('id' ,  $id)->first()->delete();
            return $story;


    }
}
