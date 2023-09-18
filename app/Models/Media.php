<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;
    public $table = 'media';
    protected $fillable = [
        'path',
        'media_type',
        'user_id',

    ];

    ########## RELATION #####################
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id' );
    }
    public function product()
    {
        return $this->belongsToMany(Product::class, 'products_mediagroups', 'media_id','product_id');
    }
#########################################
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


                    return  $VendorsGallery ;

                }else{
                    return null ;
                }





            }else{
                return null ;
            }


    }

}
