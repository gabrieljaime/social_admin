<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plans;
use Auth;


class CheckoutController extends Controller
{
   public function subscribe_process(Request $request)
{
    try {

        $user = Auth::user();
        if (substr($request->plan, -2)=='_y')
        {
            $plan=substr($request->plan, 0, strlen($request->plan)-2);
            $type='Yearly';

        }
        else
        {
             $plan= $request->plan;
             $type='Monthly';
        }

        $pl=Plans::where('name',$plan)->first();

        
        $plan_id= ($type == 'Monthly' ? $pl->stripe_id_m : $pl->stripe_id_y) ;

        $user->newSubscription('main',$plan_id)->create($request->stripeToken);

        return redirect('home')->with('success','Subscription successful to our ' . $plan . 'plan ' . $type);


    } catch (\Exception $ex) {
        return $ex->getMessage();
        return redirect('home')->with('error', 'Subscription Failed. Try again');

    }

}
   public function cancel(Request $request)
{
    try {
       

        $user = User::find(5);
        $user->subscription('main')->cancel();


        return 'Subscription successful, you get the course!';

    } catch (\Exception $ex) {
        return $ex->getMessage();
    }

}

}
