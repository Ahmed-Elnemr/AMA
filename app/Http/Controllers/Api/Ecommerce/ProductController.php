<?php

namespace App\Http\Controllers\Api\Ecommerce;

use App\Models\Product;
use App\Models\Media;
use App\Models\User;
use App\Models\BusinessInformation;
use App\Models\ProductsMediagroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
class ProductController extends Controller
{

    public function index(Request $request)
    {
        if($request->id != null) {

            return Product::where('business_information_id' , $request->id)->with('media')->with('businessInfo')->paginate(10);

        }else{

                if($request->is_featured != null ){
                    return Product::where('is_featured' , 1)->with('media')->with('businessInfo')->paginate(10);

                }else{
                    return Product::with('media')->with('businessInfo')->paginate(10);
                }



        }

    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $authUser = User::find(\Auth::id());

        $mediaList = array();
             if ($request->hasFile('images')) {


                foreach($request->file('images') as $key => $file)
                {
                    $VendorsGallery = new Media();
                    $destinationPath = storage_path("app/public/website/$authUser->id/");

                    $myimage =  time().'.'.$file->getClientOriginalName();
                    $complet_path = url('/')."/storage/website/$authUser->id/" . $myimage;
                    $file->move($destinationPath, $myimage);



                    $VendorsGallery->user_id =  $authUser->id;
                    $VendorsGallery->path  = $complet_path;
                    $VendorsGallery->media_type = "IMAGE";



                     $VendorsGallery->save();
                     $mediaList[$VendorsGallery->id] = $VendorsGallery->id;
                }








            }



            $bi = BusinessInformation::where('id' ,  $request->business_information_id)->first();
            $Product = new Product();

            $Product->products_name = $request->products_name;

            $Product->products_price = $request->products_price;

            $Product->products_unite_name = $request->products_unite_name;

            $Product->products_uinites = $request->products_uinites;

            $Product->users_id = $authUser->id;

            if($bi != null){
                $Product->categories_id = $bi->categories_id;
            }




         //   $Product->main_categories_id = $request->main_categories_id;

            $Product->business_information_id = $request->business_information_id;

            $Product->save();

            foreach( $mediaList as $k=>$v)
            {

                $ProductsMediagroup = new ProductsMediagroup();
                $ProductsMediagroup->product_id =  $Product->id;
                $ProductsMediagroup->media_id =  $k;
                $ProductsMediagroup->order = 1;
                $ProductsMediagroup->save();
            }
            return Product::where('id' , $Product->id)->with('media')->with('businessInfo')->first();


    }


    public function show(Product $product)
    {

    }


    public function edit(Product $product)
    {

    }


    public function update(Request $request, Product $product)
    {

    }


    public function destroy($id)
    {
        $authUser = User::find(\Auth::id());
        $story =  Product::where('users_id' , $authUser->id)->where('id' ,  $id)->first()->delete();
        return $story;
    }
}
