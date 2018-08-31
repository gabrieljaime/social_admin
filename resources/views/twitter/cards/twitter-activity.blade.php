<div class="mdl-card twitter-card mdl-shadow--2dp mdl-cell margin-top-0-tablet-important mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop">
    <div class="mdl-card__supporting-text  mdl-color-text--grey-600 " style="margin-top:-20px">   
        <h4>
             <i class="material-icons md-24 " style="color:red">whatshot</i> {{round($social_card->statuses_count/(now('UTC')->diffInDays($social_card->created_at)),2)}} Tweets/{{__('twitter.day')}}
        </h4>
        <h5 >
            {{$social_card->statuses_count}} Tweets {{__('twitter.in')}} {{ number_format(now('UTC')->diffInDays($social_card->created_at)) }} {{str_plural(__('twitter.day'))}}
        </h5>
       
        @if ((round($social_card->statuses_count/(now('UTC')->diffInDays($social_card->created_at)),2)<20))
          <i class="material-icons"style="color:green">sentiment_very_satisfied</i> {{__('twitter.all_right')}}
        @else
           <i class="material-icons" style="color:red">sentiment_very_dissatisfied</i>  {{__('twitter.too_noise')}}
        @endif
        
        
    </div>

    
     <div class="mdl-card__actions mdl-card--border ">
            <a href="{{url('twitter/tweets/social/'.$id)}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary">
                             {{ trans('permsandroles.permissionView')}} {{ trans('twitter.title-tweets') }}
                        </a>
            <a href="{{url('/twitter/'.$id.'/whitelist/')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                          {{ trans('permsandroles.permissionView')}} {{__('twitter.white_list')}}
                        </a>
    </div>

</div>
