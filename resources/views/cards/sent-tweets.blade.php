<div class="mdl-card mdl-shadow--2dp mdl-cell margin-top-0-tablet-important mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop weather-container">
    <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text">
           {{__('twitter.sent-tweets')}}
        </h2>
    </div>

    <div class="mdl-card__supporting-text margin-top-0 padding-top-0">
        @isset($tweets)
            @foreach ($tweets as $tweet)
                @include('twitter.cards.tweet-home') 
            @endforeach
        @else 
        <h5 style="text-align: center"> Todavia no has enviado ningun Tweet con nosotros </h5>  
        <h6> Agrega una fuente 
       <a href="{{ route('feeds.create') }}" id="add_feed">
                              <i  class="material-icons " style="word-spacing:-8px;">add_circle rss_feed</i>
                          
                         <span class="mdl-tooltip mdl-tooltip--top" for="add_feed">
                                                {{__('feed.add_tolltip')}}
                                                </span>
                        </a>
                        <h6>
        <h6> O Agenda un mensaje 
        <a href="{{ route('agenda.create') }}" id="add_agenda">
                              <i  class="material-icons " style="word-spacing:-8px;">add_circle calendar_today</i>
                          
                          <span class="mdl-tooltip mdl-tooltip--top" for="add_agenda">
                                            {{__('twitter.add_agenda_tolltip')}}
                                            </span>
                        </a></h6>
        @endisset
        
    </div>

    <div class="mdl-card__menu">


        <a href="{{ route('twitter.tweets') }}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-color-text--white " id="see_tweets">
                          <i  class="material-icons ">send</i>
        
                       <span class="mdl-tooltip mdl-tooltip--left" for="see_tweets">
                                        {{__('twitter.see-sent-tweets')}}
                                        </span>
        </a>
       
    </div>
</div>
