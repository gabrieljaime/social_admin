<div class="mdl-card twitter-card mdl-shadow--2dp mdl-cell margin-top-0-tablet-important mdl-cell--3-col mdl-cell--12-col-tablet mdl-cell--3-col-desktop">
    <div class="mdl-card__title mdl-color--accent mdl-color-text--white">
    <span class="center">{{__('plans.'.$name)}}</span> 
    </div>
    <div class="mdl-card__supporting-text  mdl-color-text--grey-600 " style="margin-top:-20px">


        <ul class="demo-list-icon mdl-list">
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
            <i class="material-icons mdl-list__item-icon limegreen">person</i> {{$profiles}} {{trans_choice('plans.profile',$profiles)}}
            </span>

            </li>
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-icon limegreen">supervisor_account</i>{{$social}} {{trans_choice('plans.social',$social)}}
                </span>

            </li>
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-icon limegreen">calendar_today</i> @if($agended==999) {{__('plans.unlimited')}} @else {{__('plans.up_to')}} {{$agended}} @endif {{__('plans.agended')}}
                </span>

            </li>
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                  <i class="material-icons mdl-list__item-icon limegreen">rss_feed</i> @if($feeds==999) {{__('plans.unlimited')}} @else {{$feeds}}  @endif {{trans_choice('plans.feed',$feeds)}}
                  </span>

            </li>
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                  <i class="material-icons mdl-list__item-icon limegreen">send</i>{{$tweets}} {{__('plans.automatic')}}
            </span>
            </li>
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content @if (!$whitelist) darkgrey @endif ">
                   
                            <i class="material-icons mdl-list__item-icon @if ($whitelist) limegreen @else darkgrey @endif">security</i>{{__('plans.whitelist')}}
                
                            </span>
            </li>
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content @if (!$unfollow) darkgrey @endif">
                                     <i class="material-icons mdl-list__item-icon @if ($unfollow) limegreen @else darkgrey @endif">delete</i> {{__('plans.unfollow')}}
                                    </span>
            </li>
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content @if (!$community) darkgrey @endif">
                               <i class="material-icons mdl-list__item-icon @if ($community) limegreen @else darkgrey @endif">record_voice_over</i> {{__('plans.community')}} @if ($community) <span style="color:lightgreen">(optional)</span> @endif
                              </span>
            </li>
            <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">attach_money</i>
                   
                 
                    <strong  @if($price_m ==0) class="limegreen" @endif>
                    @if($price_m ==0) {{__('plans.Free')}} @else {{$price_m}} @endif
                    </strong> @if($price_m !=0)&nbsp/ {{__('plans.month')}} @endif
                </span>
            </li>

    
        </ul>


    </div>


    <div class="mdl-card__actions mdl-card--border" style="margin-top: @if ($community)-47px @else -30px @endif; ">
        
        
        <a style="width:50%; align-content: center"   class=' @if($price_y ==0) dialog-button-unsubscribe @endif mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect @if ($user_plan->name==$name) mdl-button--accent @else mdl-button--primary @endif  dialog-button{{$name}} center'
            type='button' data-toggle='modal' data-target='#confirmSub{{$name}}' data-title='{{$name}}' data-message='mensaje'>
                      <i class="material-icons">@if ($user_plan->name==$name) face @else @if($price_y !=0) payment @endif @endif </i> 
                       @if ($user_plan->name==$name) {{__('plans.your_plan')}}  @else @if($price_y ==0){{__('plans.downgrade')}}  @else {{__('plans.choose_it')}}  @endif @endif
        </a>
        @if ($price_y ==0 && $user_plan->name!='Free')
            @include('dialogs.dialog-unsubscribre')
        @endif

    </div>

</div>
