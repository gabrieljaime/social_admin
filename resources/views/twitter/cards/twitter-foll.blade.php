@php
if ($type=='nf') {
    $cant=26;
}
else {
    $cant=16;
}
@endphp

@if ($friends->count()>0)
<div class="mdl-card twitter-card {{$type}}_card  mdl-shadow--2dp mdl-cell margin-top-0-tablet-important mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop">

   
     <div class="mdl-card__title mdl-color--primary mdl-color-text--white" >
      {{ trans('twitter.title-'.$type) }} -- {{$friends->count()}}  {{ trans('twitter.accounts') }} 
    </div>
    <div class="mdl-card__supporting-text mdl-card__supporting-text-twitt mdl-color-text--grey-600">
       
       
        @foreach ($friends->take( $cant) as $friend)
         

             <img  id="{{$type}}-{{$friend->get('id')}}"  src="{{$friend->get('profile_image_url')}}" alt="{{$friend->get('screen_name')}}"  class="user-avatar-twitt-cards">
             <span class="mdl-tooltip mdl-tooltip--small" for="{{$type}}-{{$friend->get('id')}}">
               {{'@'.$friend->get('screen_name')}}
            </span>
        @endforeach
         @if ($friends->count()> $cant)
        <div class="user-avatar-twitt-cards mdl-color-text--white">
        <span class="last-count-cards" >+{{$friends->count()-16}}</span> 
        </div>
         @endif
             
        

          
    </div>

    <div class="mdl-grid  margin-top-0-tablet-important mdl-cell--12-col mdl-cell--124-col-tablet mdl-cell--12-col-desktop " >
     
          <span class="mdl-card__title-text mdl-card__title-text-twitt mdl-color-text--white">
    
             
          </span>
      
    </div>
    <div class="mdl-card__actions mdl-card--border position-bottom">
             <a href="{{url('twitter/'.$id.'/'.$type)}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary">
                 {{ trans('permsandroles.permissionView')}} {{ trans('twitter.title-'.$type) }} {{ trans('twitter.accounts') }} 
            </a>
           
    </div>
  
          
    
</div>
@else
<div class="mdl-card twitter-card {{$type}}_card  mdl-shadow--2dp mdl-cell margin-top-0-tablet-important mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop">

   
     <div class="mdl-card__title mdl-color--primary mdl-color-text--white" >
      All Rigth -- No {{ trans('twitter.title-'.$type) }} Account
    </div>
    <div class="mdl-card__supporting-text mdl-card__supporting-text-twitt mdl-color-text--grey-600" style="text-align: center">
       
      <i class="material-icons" style="font-size:100px">sentiment_very_satisfied</i>
      <i class="material-icons" style="font-size:90px;margin-left: -40px;color: green;">priority_high</i>

        
    
      
          
    </div>
         
    
</div>
@endif

@section('footer_scripts')
   
@endsection