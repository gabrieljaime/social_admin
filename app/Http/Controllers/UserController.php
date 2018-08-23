<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Twitter;
use App\Models\Social;


class UserController extends Controller
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
      
        $user = Auth::user();
        $socials = Social::FromUser($user->id)->get();
        $twitters= new Twitter;
        $twitters = $twitters->GetSocials();
        

        if ($user->isAdmin()) {
            return view('pages.admin.home',compact('twitters','socials'));
        }

        return view('pages.user.home',compact('twitters','socials'));
    }
}
