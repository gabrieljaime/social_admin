    <div class="mdl-card twitter-card mdl-shadow--2dp mdl-cell margin-top-0-tablet-important mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop">
    <div class="mdl-card__supporting-text  mdl-color-text--grey-600">   
        <h4>
             <i class="material-icons md-24">whatshot</i> {{round($social_card->statuses_count/(now('UTC')->diffInDays($social_card->created_at)),2)}} Tweets/day
        </h4>
        <h5 >
            {{$social_card->statuses_count}} Tweets in {{ number_format(now('UTC')->diffInDays($social_card->created_at)) }} days
        </h5>
        <p>
          <i class="material-icons ">sentiment_satisfied</i>  You have all rigth
        </p>
        
    </div>

    
   <div class="mdl-card__actions mdl-card--border position-bottom" >
             <a href="{{url('twitter/tweets/'.$id)}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary">
                 {{ trans('permsandroles.permissionView')}} {{ trans('twitter.title-tweets') }}
            </a>
           
    </div>
          
    
</div>


@section('footer_scripts')
   
@endsection