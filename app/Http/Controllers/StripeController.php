<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Stripe;
use Stripe_Charge;
use App\Models\Subscription;
use Carbon\Carbon;
class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        //userid
       Stripe::setApiKey(env('STRIPE_SECRET'));
       $customer = Stripe_Charge::create ([
                "amount" => 20 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "payment from amaappegypt.com"
        ]);

      //  if(isset($customer->_values  )){

            if(isset( $customer->captured)){
                if($customer->captured == true)
                {
                        //$request->userid;
                        $Subscription = new Subscription();
                        $Subscription->subscription_start =  Carbon::now(); ;
                        $Subscription->subscription_end =  Carbon::now()->addDays(30);
                        $Subscription->duration_in_days  = 30 ;
                        //$Subscription->subscription_pkg_id ;
                        $Subscription->user_id  = $request->userid;
                        $Subscription->save();
                }
            }
//        }

        Session::flash('success', 'Payment successful!');

        return back();
    }
}
