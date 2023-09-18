<?php

namespace App\Http\Controllers\Api\Ecommerce;

use App\Models\OrdersDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
class OrdersDetailsController extends Controller
{

    public function index(Request $request)
    {

        return OrdersDetails::where('orders_id' ,$request->order_id )->with('product')->paginate(50);
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

        $tracks = $request->json()->all();
        foreach ($tracks as $track) {
            //$track->user_id = $authUser->id;
            OrdersDetails::create($track);
        }
        return $tracks;


    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdersDetails  $ordersDetails
     * @return \Illuminate\Http\Response
     */
    public function show(OrdersDetails $ordersDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdersDetails  $ordersDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdersDetails $ordersDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdersDetails  $ordersDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdersDetails $ordersDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdersDetails  $ordersDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdersDetails $ordersDetails)
    {
        //
    }
}
