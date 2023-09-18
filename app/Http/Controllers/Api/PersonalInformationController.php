<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PersonalInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PersonalInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = User::find(Auth::id());
        $p_info = PersonalInformation::where('user_id',  $authUser->id)->first();
        return response()->json([
            'data' => $p_info,
            'status' => 'user founded',
        ]);
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
        $authUser = User::find(Auth::id());

        if ($authUser != null) {

            $old = PersonalInformation::where('user_id', $authUser->id)->first();
            if ($old == null) {
                $personalInformation = new PersonalInformation();
                $personalInformation->user_id = $authUser->id;
                $personalInformation->first_name = $request->first_name;
                $personalInformation->last_name = $request->last_name;
                $personalInformation->gender = $request->gender;
                $personalInformation->phone = $request->phone;
                $personalInformation->bio = $request->bio;
                $personalInformation->save();
                return response()->json([
                    'data' => $personalInformation,
                    'status' => 'personal info created successfully',
                ]);
            } else {
                $personalInformation =   $old;
                $personalInformation->id = $old->id;
                $personalInformation->user_id = $authUser->id;
                $personalInformation->first_name = $request->first_name;
                $personalInformation->last_name = $request->last_name;
                $personalInformation->gender = $request->gender;
                $personalInformation->phone = $request->phone;
                $personalInformation->bio = $request->bio;
                $personalInformation->update();
                return response()->json([
                    'data' => $personalInformation,
                    'status' => 'personal info updated successfully',
                ]);
            }
        }
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
        //
    }
}
