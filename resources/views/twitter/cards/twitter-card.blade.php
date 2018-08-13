<div class="mdl-card twitter-card mdl-shadow--2dp mdl-cell margin-top-0-tablet-important mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop">

    <div class="mdl-card__title mdl-card__title-twitt" style="background-color:#{{$twitter->color}};background-image:url('{{$twitter->profile_banner_url}}')">
    
    </div>
    <div class="mdl-card__supporting-text mdl-card__supporting-text-twitt mdl-color-text--grey-600">
       
       
          <img src="{{$twitter->image_url}}" alt="{{$twitter->screen_name}}" class="user-avatar-twitt" style="border-color:#{{$twitter->color}}">
    
          <span class="mdl-card__title-text mdl-card__title-text-twitt mdl-color-text">
    
              {{$twitter->name}}
          </span>
          <span class="mdl-card__title-text mdl-card__title-text-twitt"> 
              <br>
              <a class="font-small" style="color:#{{$twitter->color}}">  
                  {{'@'.$twitter->screen_name}}
              </a>
          </span>
    </div>

    <div class="mdl-grid  margin-top-0-tablet-important mdl-cell--12-col mdl-cell--124-col-tablet mdl-cell--12-col-desktop " >
      
        <span id="fow.{{$twitter->id}}" href="#" class="mdl-button mdl-js-button  mdl-js-ripple-effect mdl-button--primary mdl-shadow--2dp mdl-cell margin-top-0-tablet-important mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop">
         <i class="material-icons">people</i>  {{$twitter->followers_count}}
        </span>
        <span class="mdl-tooltip mdl-tooltip--large" for="fow.{{$twitter->id}}">
        Followers
        </span>
            <span id="fri.{{$twitter->id}}" href="#" class="mdl-button mdl-js-button  mdl-js-ripple-effect mdl-button--accent mdl-shadow--2dp mdl-cell margin-top-0-tablet-important mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop">
               <i class="material-icons">favorite</i> {{$twitter->friends_count}}
            </span>
             <span class="mdl-tooltip mdl-tooltip--large" for="fri.{{$twitter->id}}">
            Friends
            </span>
      <span id="twit.{{$twitter->id}}" href="#" class="mdl-button mdl-js-button  mdl-js-ripple-effect mdl-button--primary mdl-shadow--2dp mdl-cell margin-top-0-tablet-important mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop">
            <i class="material-icons">create</i> {{$twitter->statuses_count}} 
            </span>  
            <span class="mdl-tooltip mdl-tooltip--large" for="twit.{{$twitter->id}}">
            Tweets
            </span>
    </div>

   <div class="mdl-card__actions mdl-card--border ">

        {!! Form::open(array('url' => 'twitter/' . $twitter->social_id,  'id' => 'delete_'.$twitter->social_id)) !!}
          
             <a href="{{url('twitter/'.$twitter->social_id) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary">
                  <i class="material-icons" aria-hidden="true"  >remove_red_eye</i> {{ trans('permsandroles.permissionView')}}  {{ trans('twitter.account') }} 
            </a>


           {!! Form::hidden('_method', 'DELETE') !!}
             <a href="#" class=" dialiog-trigger-delete dialiog-trigger{{$twitter->social_id}} mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent " data-socialid="{{$twitter->social_id}}">
               <i class="material-icons" aria-hidden="true">delete</i> {{ trans('twitter.btn-disconnect')}}  {{ trans('twitter.account') }} 
          
            </a>
            {!! Form::close() !!}
           
    </div>
  
          
    
</div>

@php
$dialogTitle =  trans('twitter.confirm_delete_title_text');
$dialogSaveBtnText =  trans('twitter.btn-disconnect');
$dialogSubTitle=  trans('twitter.confirm_delete_subtitle_text');
@endphp

@include('dialogs.dialog-delete')


@section('footer_scripts')
    <script type="text/javascript">
        
        mdl_dialog('.dialiog-trigger{{$twitter->social_id}}','','#dialog_delete');

        var socialid;
        $('.dialiog-trigger-delete').click(function(event) {
            event.preventDefault();
            socialid = $(this).attr('data-socialid');
       });
        $('#confirm').click(function(event) {
            $('form#delete_'+socialid).submit();
        });
    </script>   
@endsection