<?php

namespace App\Http\Controllers\Api\Ecommerce;
use App\Models\BusinessInformation;
use App\Models\User;
use App\Models\PersonalInformation;
use App\Models\ContactInformation;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
class BusinessInformationController extends Controller
{

    public function index(Request $request)
    {

        $authUser = User::find(\Auth::id());

        if($authUser != null && $authUser->role_id == "VENDOR" ){

            if($request->q != null && $request->q != ""){

                return BusinessInformation::where("user_id" , $authUser->id )
                ->where('legal_name', 'like', '%'.$request->q.'%')
                ->with('coverMedia')
                ->with('Location')
                ->with('logoMedia')
                ->with('contactInfo')
                ->with('category')

                ->with('isfollower')
                ->with('personal')
                ->withCount(['followeing'])
                ->withCount(['Reviews', 'followeing'])
                ->paginate(10);

            }else{
                return BusinessInformation::where("user_id" , $authUser->id )
                ->with('coverMedia')
                ->with('Location')
                ->with('logoMedia')
                ->with('contactInfo')
                ->with('category')
                ->with('isfollower')
                ->with('personal')
                ->withCount(['followeing'])
                ->paginate(10);
            }

        }else if ( $authUser != null){
                    if($request->q != null && $request->q != ""){

                    return BusinessInformation::where('categories_id' , $request->categories_id)
                    ->where('legal_name', 'like', '%'.$request->q.'%')
                    ->with('coverMedia')
                    ->with('Location')
                    ->with('logoMedia')
                    ->with('contactInfo')
                    ->with('category')

                     ->with('isfollower')
                    ->with('personal')
                    ->withCount(['followeing'])
                    ->withCount(['Reviews', 'followeing'])
                    ->paginate(10);

                }else{
                    return BusinessInformation::where('categories_id' , $request->categories_id)
                    ->with('coverMedia')
                    ->with('Location')
                    ->with('logoMedia')
                    ->with('contactInfo')
                    ->with('category')
                    ->with('isfollower')
                    ->with('personal')
                    ->withCount(['followeing'])
                    ->paginate(10);
                }
        }else {
            if($request->q != null && $request->q != ""){

            return BusinessInformation::where('categories_id' , $request->categories_id)
            ->where('legal_name', 'like', '%'.$request->q.'%')
            ->with('coverMedia')
            ->with('Location')
            ->with('logoMedia')
            ->with('contactInfo')
            ->with('category')

          //   ->with('isfollower')
            ->with('personal')
            ->withCount(['followeing'])
            ->withCount(['Reviews', 'followeing'])
            ->paginate(10);

        }else{
            return BusinessInformation::where('categories_id' , $request->categories_id)
            ->with('coverMedia')
            ->with('Location')
            ->with('logoMedia')
            ->with('contactInfo')
            ->with('category')
           // ->with('isfollower')
            ->with('personal')
            ->withCount(['followeing'])
            ->paginate(10);
        }
}







    }





    public function create()
    {

    }

    public function saveMedia(  $filename ,  $user_id){

        $m = new Media();
        if ($filename != null) {
            //$m = new Media();

            $destinationPath = storage_path("app/public/website/$user_id/");

            $myimage =  time().'.'.$filename->getClientOriginalName();
            $complet_path = url('/')."/storage/website/$user_id/" . $myimage;
            $filename->move($destinationPath, $myimage);





            $m->user_id =  $user_id;
            $m->path  = $complet_path;
             $m->media_type = "IMAGE";

             $m->save();

            return  $m->id;





        }else{
            return 1;
        }
    }
    public function saveMediaLogo(  $filename ,  $user_id){

        $m = new Media();
        if ($filename != null) {
            //$m = new Media();

            $destinationPath = storage_path("app/public/website/$user_id/");

            $myimage =  time().'.'.$filename->getClientOriginalName();
            $complet_path = url('/')."/storage/website/$user_id/" . $myimage;
            $filename->move($destinationPath, $myimage);





            $m->user_id =  $user_id;
            $m->path  = $complet_path;
             $m->media_type = "IMAGE";



          $m->save();

             return  $m->id;





         }else{
             return 1;
         }
    }

    public function store(Request $request)
    {
        $authUser = User::find(\Auth::id());
        $cover = $this->saveMedia(  $request->cover ,  $authUser->id);
        $logo =  $this->saveMediaLogo(  $request->logo ,  $authUser->id);

        $BusinessInformation = new BusinessInformation();
        $BusinessInformation->user_id = $authUser->id;
        $BusinessInformation->legal_name = $request->legal_name;
        $BusinessInformation->slug_name = $request->legal_name;
        $BusinessInformation->categories_id = $request->categories_id;
        if($cover != 1){
            $BusinessInformation->cover_media_id = $cover;
        }

        if($logo != 1){
            $BusinessInformation->logo_media_id = $logo;
        }
        $BusinessInformation->save();


        return  BusinessInformation::where('id' , $BusinessInformation->id)
                                    ->with('coverMedia')
                                    ->with('Location')
                                    ->with('logoMedia')
                                    ->with('contactInfo')
                                    ->with('category')
                                    ->with('isfollower')
                                    ->with('personal')
                                    ->withCount(['followeing'])
                                    ->first();
    }


    public function show($id)
    {
        return BusinessInformation::where('id' ,$id)
        ->with('coverMedia')
        ->with('Location')
        ->with('contactInfo')
        ->with('personal')
        ->with('user')
        ->with('isfollower')
        ->withCount(['Reviews', 'followeing'])
        ->first();

    }


    public function editlogo(Request $request){


       $authUser = User::find(\Auth::id());
       $cover = $this->saveMediaLogo(  $request->logo ,  $authUser->id);
       $b =  BusinessInformation::where('id' , $request->id)->first();
       $b->logo_media_id = $cover;
       $b->save();

    }

    public function editcover(Request $request){
        $authUser = User::find(\Auth::id());
        $cover = $this->saveMedia(  $request->cover ,  $authUser->id);
       $b =  BusinessInformation::where('id' , $request->id)->first();
       $b->cover_media_id = $cover;
       $b->save();
    }

    public function editbio(Request $request){
        $authUser = User::find(\Auth::id());
        $personalInformation =   PersonalInformation::Where('user_id' , $authUser->id )->first();

        if(  $personalInformation  != null){
            $personalInformation->bio = $request->bio;
           return  $personalInformation->save();
        }else{
            $personalInformation = new PersonalInformation();
            $personalInformation->first_name = "  ";
            $personalInformation->last_name = "  ";
            $personalInformation->gender = "  ";
            $personalInformation->phone = "   ";

            $personalInformation->user_id = $authUser->id;
            $personalInformation->bio = $request->bio;
            return $personalInformation->save();
        }

    }


    public function addcontact(Request $request){


        $ContactInformation = new ContactInformation();


        $authUser = User::find(\Auth::id());
        $ContactInformation->business_information_id = $request->id;
        $ContactInformation->user_id =   $authUser->id;
        $ContactInformation->value =   $request->info;
        $ContactInformation->type =   "contact";

        return $ContactInformation->save();


    }

    public function deletecontact(Request $request)
    {
        $authUser = User::find(\Auth::id());
        $story =  ContactInformation::where('user_id' , $authUser->id)->where('id' ,  $request->id)->first()->delete();
        return $story;
    }





    public function edit(BusinessInformation $businessInformation)
    {

    }


    public function update(Request $request, BusinessInformation $businessInformation)
    {

    }


    public function destroy(BusinessInformation $businessInformation)
    {

    }
}
