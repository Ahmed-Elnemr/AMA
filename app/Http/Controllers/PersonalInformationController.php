<?php

namespace App\Http\Controllers;

use App\Models\PersonalInformation;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;


class PersonalInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    public function show($id)
    {

        $order = Order::Where('id' , $id)->first();
        if($order != null){
            $personal =  PersonalInformation::Where('user_id' , $order->user_id)->first();
            $address = Address::Where('user_id' , $order->user_id)->get();
        }else{
            $personal =  PersonalInformation::Where('user_id' , $id)->first();
            $address = Address::Where('user_id' , $id)->get();
        }


        return array(
                    "personal" => $personal ,
                     "address" => $address
                    );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonalInformation  $personalInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalInformation $personalInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonalInformation  $personalInformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalInformation $personalInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonalInformation  $personalInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalInformation $personalInformation)
    {
        //
    }
}
