<div class="mdl-card mdl-card-twitt mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-desktop margin-top-0">
    <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text logo-style">
         
			@if (count($twitters)  === 1)
			{{ count($twitters) }} Twitter Account 
            @elseif (count($twitters) > 1)
                {{ count($twitters) }} Twitters Accounts 
            @else
               	You don't have Twitter Account Related Yet
            @endif
            
            	<div class="mdl-layout--large-screen-only">
			<i class="material-icons">arrow_forward</i>
			  <span id="fow" href="#" >
		 
	
		<i class="material-icons">people</i>{{$twitters->sum('followers_count')}}
        </span>
        <span class="mdl-tooltip mdl-tooltip--large" for="fow">Followers
        </span>
            <span id="fri" href="#" >
               <i class="material-icons">favorite</i>{{$twitters->sum('friends_count')}}
            </span>
             <span class="mdl-tooltip mdl-tooltip--large" for="fri">Friends
            </span>
            <span id="twit" href="#" >
            <i class="material-icons">create</i>{{$twitters->sum('statuses_count')}} 
            </span>  
            <span class="mdl-tooltip mdl-tooltip--large" for="twit">Tweets
            </span>
        </div>
		</h2>
		
       
    </div>	
    <div class="mdl-grid" style="margin:0px">

        @foreach ( $twitters as $twitter )
             @include('twitter.cards.twitter-card')
        @endforeach
     
    </div>
    
    @include('twitter.cards.twitter-add')

@section('footer_scripts')
   
@endsection