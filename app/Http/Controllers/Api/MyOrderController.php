<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
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

            $setOrder = Order::where('user_id', $authUser->id)->with('address')->with('orders')->paginate(10);
            /*if ($authUser->role_id == 'USER' && $setOrder != null) {
                $orders = Order::where('user_id', $authUser->id)
                    ->with('businessInfo')
                    ->with('address')
                    ->with('user')->orderBy('id', 'DESC')->paginate(10);
                $orders->makeHidden(['user_id', 'business_information_id', 'address_id', 'orderscol']);

                return response()->json([
                    'data' => $orders,
                    'status' => 'order founded'

                ]);

            } else {
                return response()->json([
                    'status' => 'no order yet or  user is not customer'

                ]);
            } */

            return $setOrder;
        }
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $authUser = User::find(\Auth::id());
        if($authUser != null)
        {

            if($request->id != null) {

                $order =  Order::where('id' , $request->id)->first();

                $order->status = $request->status;
                $order->save();

            }else{
                  $order = new Order();
                $order->status = "pending";
                $order->total = $request->total;
                $order->user_id = $authUser->id;
                $order->business_information_id = $request->business_information_id;
                $order->address_id = $request->address_id;
                $order->save();
            }




            return $order;
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

     public function update(Request $request , $id)
    {
        $order = new Order();
        $order->id = $request->id;
        $order->status = $request->status;
        $order->save();
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
