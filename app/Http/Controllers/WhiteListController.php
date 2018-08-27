<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwitterWhiteList;
use App\Models\Social;
use App\Models\FriendsShort;
use Cache;
use Auth;
use Redirect;
use Log;
class WhiteListController extends Controller
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
	
	public function addwhitelist($id, Request $request){
		
		$whitelist =new TwitterWhiteList();
		$friend= $request['friend'];
		$whitelist->social_id=$id;
		$friend=json_decode(base64_decode($friend));
		$whitelist->friend_id=$friend->id;
		$whitelist->profile_image_url=$friend->profile_image_url;
		$whitelist->screen_name=$friend->screen_name;
		$whitelist->name=$friend->name;
		$whitelist->verified=$friend->verified;
		$whitelist->location=$friend->location;

		
		if (Cache::has('friends-' . $id)) {

			$friends = unserialize(Cache::get('friends-' . $id));
			
			Cache::forget('friends-' . $id);


			$white=$friends->keyby('id')->pull($whitelist->friend_id);
			
			$friends=$friends->keyby('id')->forget($whitelist->friend_id);


			$white['whitelist'] = true;

			$friends->push($white);

			Cache::put('friends-' . $id, serialize($friends), 15);

		}

		$whitelist->save();



		return Redirect::back()->with('status', 'Add Friend to WhiteList');

	}
	
	 public function whitelist($id){

	   $social = Social::with('whitelist')->find($id);

	   return view('whitelist.index',compact( 'social'));
		

	}
	 public function whitelistall(){

	 	$user = Auth::user();
		$socials = Social::with('whitelist')->FromUser($user->id)->get();	
	
		
	   return view('whitelist.index',compact( 'socials'));		

	}
	 public function delete(Request $request){

	  $id= $request['id'];
	  
	  $whitelist= TwitterWhiteList::find($id);
	  $social = Social::with('whitelist')->find( $whitelist->social_id);	
		  
	   $whitelist->delete();


		if (Cache::has('friends-' . $social->id)) {


			$friends = unserialize(Cache::get('friends-' . $social->id));

			
			Cache::forget('friends-' . $social->id);


			$white = $friends->keyby('id')->pull($whitelist->friend_id);

			$friends = $friends->keyby('id')->forget($whitelist->friend_id);


			$white['whitelist'] = false;

			
			
			$friends->push($white);

			info($friends->keyby('id'));


			Cache::put('friends-' . $social->id, serialize($friends), 15);

		}



	    if ($request->ajax()) {

            $returnData = [
                'title'     =>'Delete White List',
                'message'   => 'White List Deleted Successfully',
            ];

            return response()->json($returnData, 200);
        }

	
		return view('whitelist.index',compact('social'))->with('status', 'White List Deleted Successfully');


	}
}
