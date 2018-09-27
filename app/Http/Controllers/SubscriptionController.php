<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plans;

class SubscriptionController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();

        $plansFree = Plans::Active()->Free()->get();
        $plansNoFree= Plans::Active()->NoFree()->get();
        $user_plan=$user->Plan();

        

        

        return view('subscription.index',compact('plansFree','plansNoFree','user_plan','user'));
    }

    public function cancel()
    {
      
        try {
            $user = \Auth::user();

            
            $user->subscription('main')->cancel();
            
            return redirect()->action('ProfilesController@account')->with('success', 'You have UnSubscribe successful');
            
        } catch (\Exception $ex) {
            return redirect()->action('ProfilesController@account')->with('error', $ex->getMessage());
        }   

    }

    public function change(Request $request)
    {
      
    
   try {
       $user = \Auth::user();

 
       $user->subscription('main')->swap($request->subscription_plan);

       return redirect()->action('ProfilesController@account')->with('success', 'You have change your Subscription successful');
            
        } catch (\Exception $ex) {
            return redirect()->action('ProfilesController@account')->with('error', $ex->getMessage());
        } 

    }

    
    public function resume()
    {
      
        try {
            $user = \Auth::user();


            $user->subscription('main')->resume();

            
            return redirect()->action('ProfilesController@account')->with('success', 'You have Resume your Subscription successful');
            
        } catch (\Exception $ex) {
            return redirect()->action('ProfilesController@account')->with('error', $ex->getMessage());
        }   

    }
    

}
