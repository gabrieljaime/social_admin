@extends('layouts.dashboard')

@section('template_title')
    Welcome {{ Auth::user()->name }}
@endsection

@section('header')
	{{ trans('auth.loggedIn', ['name' => Auth::user()->name]) }}
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
	<li class="active">
		{{ trans('titles.dashboard') }}
	</li>

@endsection

@section('content')



	<div class="mdl-card mdl-card-twitt mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-desktop margin-top-0">
		<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
			<h2 class="mdl-card__title-text logo-style">
			

				
				Twitter Account  {{'@'.$social_card->screen_name }}
			
			
			
				<i class="material-icons">arrow_forward</i>
				<span id="fow" href="#" >
			
			
					<i class="material-icons">people</i>{{$social_card->followers_count}}
			</span>
			<span class="mdl-tooltip mdl-tooltip--large" for="fow">Followers
			</span>
				<span id="fri" href="#" >
				<i class="material-icons">favorite</i>{{$social_card->friends_count}}
				</span>
				<span class="mdl-tooltip mdl-tooltip--large" for="fri">Friends
				</span>
				<span id="twit" href="#" >
				<i class="material-icons">create</i>{{$social_card->statuses_count}} 
				</span>  
				<span class="mdl-tooltip mdl-tooltip--large" for="twit">Tweets
				</span>

			</h2>
			
			
		</div>	
		<div class="mdl-grid" style="margin:0px">
			@include('twitter.cards.twitter-card', ['twitter' => $social_card])
			 @include('twitter..cards.twitter-foll', ['friends' => $friends->where('nofollow', true),'type'=>'nf'])
			 @include('twitter.cards.twitter-foll',  ['friends' => $friends->where('noactive', true),'type'=>'no'])
			 @include('twitter.cards.twitter-activity')
			 @include('twitter.cards.twitter-foll', ['friends' => $friends->where('spam', true),'type'=>'sp'])
			 @include('twitter.cards.twitter-foll', ['friends' => $friends->where('tooactive', true),'type'=>'ta'])
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

@section('footer_scripts')

@endsection