@php

    $levelAmount      = 'level';

    if (Auth::User()->level() >= 2) {
        $levelAmount = 'levels';
    }

@endphp

<div class="{{ $userCardBg }} mdl-card__title @if (Auth::user()->profile->user_profile_bg == NULL) @endif" @if (Auth::user()->profile->user_profile_bg != NULL) style="background: url('{{Auth::user()->profile->user_profile_bg}}') center/cover;" @endif>
    <h2 class="mdl-card__title-text mdl-title-username mdl-color-text--white text-center">
        {{__('welcome.hi')}} {{ Auth::user()->name }}&nbsp; <sup class="supidc">({{__('plans.'.Auth::user()->Plan()->name)}})</sup>
    </h2>
</div>
<div class="mdl-card__supporting-text mdl-color-text--grey-600">
    <div style="display:flex">
        <em>{{__('welcome.thank')}}&nbsp; </em> {{__('welcome.checking')}} 
        
        &nbsp;&nbsp;<strong>{{__('welcome.follow')}} </strong>
     <div style="margin-top: -8px; padding-left: 5px;">   
     <a href="https://twitter.com/Social_Admins?ref_src=twsrc%5Etfw" class="twitter-follow-button"  data-size="large" data-show-screen-name="false"
        data-show-count="false">Follow @Social_Admins</a>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
     </div></div>
     <br>
    <p>
        
    </p>
    <p>
        <small>
            <i class="material-icons md-18 vertical-align-minus-4">verified_user</i>{{__('welcome.register_social')}}
        </small>
    </p>
    <hr>
    <div>
        <p>
            {!!__('welcome.subscribe')!!}
                <a href="{{ route('subscription') }}" id="subscribe">
                          <i  class="material-icons " style="word-spacing:-8px;">add_circle card_membership</i>
                      
                     <span class="mdl-tooltip mdl-tooltip--top" for="subscribe">
                                            {{__('plans.subscribe_plans')}}
                                            </span>
                    </a>
        </p>
    
    </div>
    <hr>
    <div >
    <p>
        {{__('welcome.add_twitter')}}
    
            <a href="{{ route('social.redirect', ['provider' => 'twitter']) }}"  class="social-twitter " id="add_twitter">
                  <i  class="material-icons ">add_circle</i>
                <svg viewBox="0 0 100 100" class="twitter-add_icon" >
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#shape-twitter"></use>
                </svg>
               <span class="mdl-tooltip mdl-tooltip--top" for="add_twitter">
                                {{__('twitter.add_tolltip')}}
                                </span>
            </a>
    </p>        
          <p>
    <small>{{__('welcome.free_accounts',['cant'=>$user_plan->social, 'plan'=>$user_plan->name])}} </small>
          </p>
        
    </div>
    <hr>
   <div>
       <p>

        {{__('welcome.add_rss')}}
    
        <a href="{{ route('feeds.create') }}" id="add_feed">
                      <i  class="material-icons " style="word-spacing:-8px;">add_circle rss_feed</i>
                  
                 <span class="mdl-tooltip mdl-tooltip--top" for="add_feed">
                                        {{__('feed.add_tolltip')}}
                                        </span>
                </a>
    </p>
    <p>
        <small>{{__('welcome.feed_small')}}</small>
        <small>{{__('welcome.free_feed', ['cant'=>$user_plan->feed])}}</small>
    </p>
    
    </div>

  
        <hr>
<div>
    <p>
    {{__('welcome.add_agenda')}}

    <a href="{{ route('agenda.create') }}" id="add_agenda">
                      <i  class="material-icons " style="word-spacing:-8px;">add_circle calendar_today</i>
                  
                  <span class="mdl-tooltip mdl-tooltip--top" for="add_agenda">
                                    {{__('twitter.add_agenda_tolltip')}}
                                    </span>
                </a>
</p>
<p>
    <small>{{__('welcome.agenda_small')}}</small>
</p>

</div>

    <br />
    <br />   
</div>
