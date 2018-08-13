<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Social;
use App\Models\User;
use App\Traits\ActivationTrait;
use App\Traits\CaptureIpTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use jeremykenedy\LaravelRoles\Models\Role;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Illuminate\View\View;
use Cache;

class SocialController extends Controller
{
    use ActivationTrait;

    public function getSocialRedirect($provider)
    {

      
        $providerKey = Config::get('services.'.$provider);

        if (empty($providerKey)) {
            return view('pages.status')
                ->with('error', trans('socials.noProvider'));
        }

        return Socialite::driver($provider)->redirect();
    }

    public function getSocialHandle($provider)
    {
        


       if (Auth::check())
       {
        if (Input::get('denied') != '') {
            return redirect()->to('home')
                ->with('status', 'danger')
                ->with('message', trans('socials.denied'));
        }

        $socialUserObject = Socialite::driver($provider)->user();

    
        $socialUser = null;
        
      
        $user = Auth::user();
        

        $email = $socialUserObject->email;

            $sameSocialId = Social::where('social_id', '=', $socialUserObject->id)
                ->where('provider', '=', $provider)
                ->where('user_id','=', $user->id)
                ->first();

  
            if (empty($sameSocialId)) {
                $socialData = new Social();
                $username = $socialUserObject->nickname;

                if ($username == null) {
                    foreach ($fullname as $name) {
                        $username .= $name;
                    }
                }

                $socialData->social_name = $username;
                $socialData->social_id = $socialUserObject->id;
                $socialData->name =$socialUserObject->name;
               
                $socialData->provider = $provider;
                if ($provider=='twitter')
                {
                $socialData->color =$socialUserObject->user['profile_link_color'];
                $socialData->image = substr($socialUserObject->user['profile_image_url'],0,-10 ).'bigger.'.substr($socialUserObject->user['profile_image_url'],-3 );
               
                }
                $socialData->token =  $socialUserObject->token;
                $socialData->secret =  $socialUserObject->tokenSecret;
                $user->social()->save($socialData);
                
                 if (Cache::has('GetSocials-'.$user->id))
                    {
                         Cache::forget('GetSocials-'.$user->id);
                    }


            } else {
                return redirect()->to('home')
                ->with('error', 'Social User already Related');
            }

            return redirect('home')->with('success','Social User Related Successful');
        

      

    
       }
        else
        {
             if (Input::get('denied') != '') {
            return redirect()->to('login')
                ->with('status', 'danger')
                ->with('message', trans('socials.denied'));
            }

        $socialUserObject = Socialite::driver($provider)->user();

        $socialUser = null;
        // Check if email is already registered
        $userCheck = User::where('email', '=', $socialUserObject->email)->first();

        $email = $socialUserObject->email;

        if (!$socialUserObject->email) {
            $email = 'missing'.str_random(10);
        }

        if (empty($userCheck)) {
            $sameSocialId = Social::where('social_id', '=', $socialUserObject->id)
                ->where('provider', '=', $provider)
                ->first();

            if (empty($sameSocialId)) {
                $ipAddress = new CaptureIpTrait();
                $socialData = new Social();
                $profile = new Profile();
                $role = Role::where('name', '=', 'user')->first();
                $fullname = explode(' ', $socialUserObject->name);
                if (count($fullname) == 1) {
                    $fullname[1] = '';
                }
                $username = $socialUserObject->nickname;

                if ($username == null) {
                    foreach ($fullname as $name) {
                        $username .= $name;
                    }
                }

                $user = User::create([
                    'name'                  => $username,
                    'first_name'            => $fullname[0],
                    'last_name'             => $fullname[1],
                    'email'                 => $email,
                    'password'              => bcrypt(str_random(40)),
                    'token'                 => str_random(64),
                    'activated'             => true,
                    'signup_sm_ip_address'  => $ipAddress->getClientIp(),

                ]);

                $socialData->social_id = $socialUserObject->id;
                $socialData->provider = $provider;
                $socialData->token =  $socialUserObject->token;
                $socialData->secret =  $socialUserObject->tokenSecret;
                $user->social()->save($socialData);
                $user->attachRole($role);
                $user->activated = true;

                $user->profile()->save($profile);
                $user->save();

                if ($socialData->provider == 'github') {
                    $user->profile->github_username = $socialUserObject->nickname;
                }
              
                if ($socialData->provider == 'twitter') {
                    $user->profile()->twitter_username = $socialUserObject->nickname;
                }
                $user->profile->save();

                $socialUser = $user;
            } else {
                $socialUser = $sameSocialId->user;
            }

            auth()->login($socialUser, true);

            return redirect('home')->with('success', trans('socials.registerSuccess'));
        }

        $socialUser = $userCheck;

        auth()->login($socialUser, true);
   
        }
        return redirect('home');
    }
    public function getTwitterActiveAccounts(View $view)
    {
        $user = Auth::user();
        $accounts = Social::FromProvider('twitter')->FromUser($user->id)->get();

        $view->with('activeaccounts', $accounts);
    }

}
