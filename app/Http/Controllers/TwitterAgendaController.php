<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TwitterAgenda;
use App\Models\Twitter;
use App\Models\Social;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Redirect;
use Cloudder;

class TwitterAgendaController extends Controller
{
     protected $rules = [
        'text' => 'required|max:258'
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
        $agendas = TwitterAgenda::fromUser( $user->id)->get();  
        
        return view('twitter.agenda.index',compact('agendas', 'user'));
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
        $agenda= new TwitterAgenda();
        
        return view('twitter.agenda.create',compact( 'socials','agenda'));
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
        $agenda = $request->all();
        $agenda['active'] = (is_null($request->input('active'))) ? 0 : 1 ;
        $agenda= array_add($agenda, 'user_id', $user->id);
         if ( $agenda['submit']=='now')
        {
            $agenda['active'] = false;
            $agenda['publication_date']=now()->toDateString();
            $agenda['publication_at']=now()->toTimeString();
            $agenda['frequency']=1;
            
        }

        $newagenda =TwitterAgenda::create($agenda);
         if ($request->hasFile('image')) {
            

            $image = $request->file('image')->getRealPath();
            $cloud=Cloudder::upload($image, "twitter/". $newagenda->social_id."/".$newagenda->id, array ( "overwrite" => TRUE));
            // Save the public image path
            $newagenda->image =$cloud->getResult()['version'];
            $newagenda->save();
         }

        if ( $agenda['submit']=='now')
        {
            $newagenda=array_add($newagenda,  'origin','agenda_now');
            $tweet=new Twitter();
            $tweet->MakeaTwitt($newagenda);  
             return redirect('/twitter/agenda')->with('status', 'Twitt Posted'); 
   
        }
      

        return redirect('/twitter/agenda')->with('status', 'Twitt Agended');
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
        $agenda = TwitterAgenda::findOrFail($id);

        $user = Auth::user();
        $socials = Social::FromUser($user->id)->get();

        return view('twitter.agenda.edit',compact( 'agenda', 'socials'));
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
        
        $agenda = TwitterAgenda::findOrFail($id);
       
        $this->validate($request, $this->rules);

         $agenda->image=null;

        
         if ($request->hasFile('image')) {
            
           
            $image = $request->file('image')->getRealPath();
            $cloud=Cloudder::upload($image, "twitter/". $agenda->social_id."/".$id, array ( "overwrite" => TRUE));
            $agenda->image=$cloud->getResult()['version'];
            // Save the public image path
         }
        
        $agenda->social_id=$request->input('social_id');
        $agenda->name=$request->input('name');
        $agenda->text=$request->input('text');
        
        $agenda->link=$request->input('link');
        $agenda->publication_date=$request->input('publication_date');
        $agenda->publication_at=$request->input('publication_at');
        $agenda->frequency=$request->input('frequency');
        $agenda->active=(is_null($request->input('active'))) ? 0 : 1 ;
        
        if ($agenda->active == '0') {
            $return_msg = 'Twitt Deactivated!';
        } else {
            $return_msg = 'Twitt Agenda Updated';
        }

        
        
        $agenda->save();

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
        TwitterAgenda::findOrFail($id)->delete();

        return redirect('/twitter/agenda')->with('status', 'Twitt Agended Deleted');
    }

    
    
}
