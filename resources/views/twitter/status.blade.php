@extends('layouts.dashboard')

@section('template_title')
   {{'@'.$social_card->screen_name }}
@endsection

@section('header')
	{{__('twitter.twitter_account')}}  {{'@'.$social_card->screen_name }}
@endsection

@section('breadcrumbs')

	<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
		<a itemprop="item" href="{{url('/')}}">
			<span itemprop="name">
				{{ trans('titles.app') }}
			</span>
		</a>
		<i class="material-icons">chevron_right</i>
		<meta itemprop="position" content="1" />
	</li>
	 <li  itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="/twitter" >
            <span itemprop="name">
                Twitter's
            </span>
        </a>
         <i class="material-icons">chevron_right</i>
        <meta itemprop="position" content="2" />
    </li>
     <li  itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
     <a itemprop="item" href="/twitter/{{ $id }}" >
            <span itemprop="name">
              {{'@'.$social_card->screen_name}}
            </span>
        </a>
       
        <meta itemprop="position" content="3" />
    </li>

@endsection

@section('content')



	<div class="mdl-card mdl-card-twitt mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-desktop margin-top-0">
		<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
			<h2 class="mdl-card__title-text logo-style">
			

				
				{{__('twitter.twitter_account')}}  {{'@'.$social_card->screen_name }}
			
			
			
				<i class="material-icons">arrow_forward</i>
				<span id="fow" href="#" >
			
			
					<i class="material-icons">people</i>{{$social_card->followers_count}}
			</span>
			<span class="mdl-tooltip mdl-tooltip--large" for="fow">{{__('twitter.followers')}}
			</span>
				<span id="fri" href="#" >
				<i class="material-icons">favorite</i>{{$social_card->friends_count}}
				</span>
				<span class="mdl-tooltip mdl-tooltip--large" for="fri">{{__('twitter.friends')}}
				</span>
				<span id="twit" href="#" >
				<i class="material-icons">create</i>{{$social_card->statuses_count}} 
				</span>  
				<span class="mdl-tooltip mdl-tooltip--large" for="twit">{{__('twitter.tweets')}}
				</span>

			</h2>
			
			
		</div>	
		<div class="mdl-grid" style="margin:0px">
			@include('twitter.cards.twitter-card', ['twitter' => $social_card])
			@includeWhen($friends->where('nofollow', true)->count()>0,'twitter.cards.twitter-foll', ['friends' => $friends->where('whitelist',false)->where('nofollow', true),'type'=>'nf'])
			@includeWhen($friends->where('noactive', true)->count()>0,'twitter.cards.twitter-foll',  ['friends' => $friends->where('whitelist',false)->where('noactive', true),'type'=>'no'])
			@include('twitter.cards.twitter-activity')
			@includeWhen($friends->where('spam', true)->count()>0,'twitter.cards.twitter-foll', ['friends' => $friends->where('whitelist',false)->where('spam', true),'type'=>'sp'])
			@includeWhen($friends->where('tooactive', true)->count()>0,'twitter.cards.twitter-foll', ['friends' => $friends->where('whitelist',false)->where('tooactive', true),'type'=>'ta'])
		 </div>
	

	</div>  
	
		
		
		

		{{--
			<div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell--12-col-desktop">

				@include('modules.table')

			</div>

			<div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell--12-col-desktop">

				@include('modules.mega-footer')

			</div>

			<div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell--12-col-desktop">

				@include('modules.mini-footer')

			</div>
		--}}

@endsection
@php 
$dialogTitle = trans('twitter.confirm_delete_title_text'); 
$dialogSaveBtnText = trans('twitter.btn-disconnect'); 
$dialogSubTitle=trans('twitter.confirm_delete_subtitle_text'); 
@endphp
	@include('dialogs.dialog-delete')
@section('footer_scripts')
<script type="text/javascript">
	
	mdl_dialog('.dialiog-trigger{{$id}}','','#dialog_delete');

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
@endsection