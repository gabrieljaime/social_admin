<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feed;
use App\Models\Social;
use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Redirect;

class FeedsController extends Controller
{
     protected $rules = [
        'feed'          => 'required|max:500',
        'name'          => 'required|max:100',
        'begin'         => 'max:50',
        'end'           => 'max:50',
    ];
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          
        $user = Auth::user();

        $feeds = Feed::FromUser($user->id)->orderBy('created_at', 'asc')->get();

        return view('feeds.index',compact('feeds', 'user'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $user = Auth::user();
        $socials = Social::FromUser($user->id)->get();
        
        return view('feeds.create',compact( 'socials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $user = Auth::user();
        $feed = $request->all();
        $feed['shorten_url'] = (is_null($request->input('shorten_url'))) ? 0 : 1 ;
        $feed['active'] = (is_null($request->input('active'))) ? 0 : 1 ;

        Feed::create($feed);

        return redirect('/feeds')->with('status', __('feed.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feed = Feed::findOrFail($id);

        $user = Auth::user();
        $socials = Social::FromUser($user->id)->get();

        return view('feeds.edit',compact( 'feed', 'socials'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules);
       
        $feed = Feed::findOrFail($id);
        $feed->feed =$request->input('feed');
        $feed->name =$request->input('name');
        $feed->begin =$request->input('begin');
        $feed->end =$request->input('end');
        $feed->term_to_check =$request->input('term_to_check');
        $feed->post_by_check =$request->input('post_by_check');
        $feed->daily_posts = $request->input('daily_posts') ;
        $feed->shorten_url = (is_null($request->input('shorten_url'))) ? 0 : 1 ;
        $feed->active = (is_null($request->input('active'))) ? 0 : 1 ;
        $feed->social_id =$request->input('social_id');
       
        if ($feed->active == '0') {
            $return_msg = __('feed.desactived');
        } else {
            $return_msg = __('feed.updated');
        }


        $feed->save();

        return Redirect::back()->with('status', $return_msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Feed::findOrFail($id)->delete();

        return redirect('/feeds')->with('status',__('feed.deleted'));
    }

    public function getActiveFeeds(View $view)
    {
        $feeds = Feed::Active()->FromUser(Auth::user()->id)->get();

        $view->with('activefeeds', $feeds);
    }
}
