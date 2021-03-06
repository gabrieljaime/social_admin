<div class="mdl-card mdl-card-twitt mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-desktop margin-top-0">
    <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text logo-style">
         
			@if (count($twitters)  > 0)
			{{ count($twitters) }} {{ trans_choice('twitter.twitter_accounts',count($twitters))}}
            @else
            {{ trans_choice('twitter.twitter_accounts',0)}}
            @endif
            
            

            	<div class="mdl-layout--large-screen-only">
			<i class="material-icons">arrow_forward</i>
			  <span id="fow" href="#" >
		 
	
		<i class="material-icons">people</i>{{$twitters->sum('followers_count')}}
        </span>
        <span class="mdl-tooltip mdl-tooltip--large" for="fow">{{__('twitter.followers')}}
        </span>
            <span id="fri" href="#" >
               <i class="material-icons">favorite</i>{{$twitters->sum('friends_count')}}
            </span>
             <span class="mdl-tooltip mdl-tooltip--large" for="fri">{{__('twitter.friends')}}
            </span>
            <span id="twit" href="#" >
            <i class="material-icons">create</i>{{$twitters->sum('statuses_count')}} 
            </span>  
            <span class="mdl-tooltip mdl-tooltip--large" for="twit">{{__('twitter.tweets')}}
            </span>
    </div>
		</h2>
		
       
</div>	
    <div class="mdl-grid" style="margin:0px">

        @foreach ( $twitters as $twitter )
             @include('twitter.cards.twitter-card')
        @endforeach
     
    </div>
    <div class="mdl-card__menu" style="top:4px;">
        @include('twitter.cards.twitter-add')
    </div>


@php $dialogTitle = trans('twitter.confirm_delete_title_text'); 
$dialogSaveBtnText = trans('twitter.btn-disconnect'); 
$dialogSubTitle= trans('twitter.confirm_delete_subtitle_text'); 
@endphp
    @include('dialogs.dialog-delete')
    
@section('footer_scripts')

<script type="text/javascript">

        @foreach ( $twitters as $twitter )
            mdl_dialog('.dialiog-trigger{{$twitter->social_id}}','','#dialog_delete');
        @endforeach
    
            var socialid;
            $('.dialiog-trigger-delete').click(function(event) {
                event.preventDefault();
                socialid = $(this).attr('data-socialid');
        
           });
            $('#confirm').click(function(event) {
              $('#confirm .mdl-spinner-text').fadeOut(1, function()
               { $('#confirm .mdl-spinner').addClass('is-active'); }); 
               $('form#delete_'+socialid).submit();
            });
</script>
@append