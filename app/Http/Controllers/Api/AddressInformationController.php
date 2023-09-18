<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = User::find(Auth::id());
        if ($authUser != null) {
            $address = Address::where('user_id',  $authUser->id)->paginate(10);
            return $address;
        }
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

  
    public function store(Request $request)
    {

        $authUser = User::find(Auth::id());
        if($authUser != null)
        {

            $Address = new Address();
            $Address->user_id = $authUser->id ;
            $Address->country  = $request->country;
            $Address->city = $request->city;
            $Address->street = $request->street;
            $Address->landmark = $request->landmark;
            $Address->floor = $request->floor;
            $Address->flat = $request->flat;
            $Address->save();
            return $Address;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $authUser = User::find(Auth::id());
        $not =  Address::findOrFail($id);

        if($authUser->id  == $not->user_id)
        {
            return Address::destroy($id);
        }
    }
}
