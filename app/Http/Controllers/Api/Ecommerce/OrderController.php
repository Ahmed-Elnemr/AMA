<?php

namespace App\Http\Controllers\Api\Ecommerce;

use App\Models\Order;
use App\Models\User;
use App\Models\BusinessInformation;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{

    public function index()
    {

        $authUser = User::find(Auth::id());
        if ($authUser != null) {

            $ids = BusinessInformation::where('user_id' , $authUser->id)->pluck('id');
            $setOrder = Order::WhereIn('business_information_id', $ids)->with('address')->with('orders')->paginate(10);


            return $setOrder;
        }

    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }


    public function show(Order $order)
    {

    }


    public function edit(Order $order)
    {

    }


    public function update(Request $request, Order $order)
    {

    }


    public function destroy(Order $order)
    {

    }
}
