@extends('layouts.dashboard')

@section('template_title')
  Showing {{'@'.$social->social_name}} 
@endsection

@section('template_linked_css')
@endsection

@section('header')
	{{ trans('twitter.title-'.$type) }} {{ trans('twitter.account') }} 
@endsection

@section('breadcrumbs')
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
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
	 <a itemprop="item" href="/twitter/{{ $social->id }}" >
			<span itemprop="name">
			   {{'@'.$social->social_name}}
			</span>
		</a>
		 <i class="material-icons">chevron_right</i>
		<meta itemprop="position" content="3" />
	</li>
	 <li  itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
	 <a class="active" itemprop="item" href="/twitter/{{ $social->id }}/{{$type}}" disabled>
			<span itemprop="name">
			   {{ trans('twitter.title-'.$type) }}
			</span>
		</a>
		<meta itemprop="position" content="4" />
	</li>
@endsection

@section('content')

<div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell--12-col-desktop margin-top-0">
	<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
		<h2 class="mdl-card__title-text logo-style">
				@if (count($friends) > 0) 
					{{ count($friends) }} {{ trans_choice('twitter.twitter_accounts',count($friends))}}
			 @else
			      {{trans_choice('twitter.twitter_accounts',0)}} 
			@endif
		</h2>

	</div>
	<div class="mdl-card__supporting-text mdl-color-text--grey-600 padding-0 context">
		<div class="table-responsive material-table">
		   @if ($friends->count()>0) 
			<table id="friendsshort_table" class="mdl-data-table mdl-js-data-table   data-table" cellspacing="0" width="100%">
									
				<thead>
				<tr>
				
					<th class="mdl-data-table__cell--non-numeric">{{__('twitter.cl_name')}}</th>
					<th class="mdl-data-table__cell--non-numeric">{{__('twitter.cl_tweets')}}</th>
					 <th class="mdl-data-table__cell--non-numeric">{{__('twitter.cl_joined')}}</th>
					  <th class="mdl-data-table__cell--non-numeric">{{__('twitter.cl_activity')}}</th>
					  <th class="mdl-data-table__cell--non-numeric">{{__('twitter.cl_friends')}}</th>
					   <th class="mdl-data-table__cell--non-numeric">{{__('twitter.cl_followers')}}</th>
					<th class="mdl-data-table__cell--non-numeric no-sort no-search">{{__('twitter.cl_actions')}}</th>
				</tr>
			  </thead>
			  <tbody>
					@foreach ($friends as $friend)
						<tr>
						   <td class="mdl-data-table__cell--non-numeric">
							   <div class="left">		
								  <img  id="{{$friend->get('id')}}"  src="{{$friend->get('profile_image_url')}}" alt="{{$friend->get('screen_name')}}"  class="user-avatar-twitt-list">
								</div>
								<div class="name-twitter">		
									<p class="no-margin fs-12 ">	

										<span class="bold"> {{$friend->get('name')}}
											@if ($friend->get('verified'))
												<i class="check-twitter material-icons fs-12" aria-hidden="true">check_circle</i>
											@endif 
											
											<br>			
											<span class="semi-bold">
												<a href="https://twitter.com/{{'@'.$friend->get('screen_name')}}" target="_blank"> {{'@'.$friend->get('screen_name')}}</a>
											</span>		
										</span>
									</p>	
									@if ($friend->get('location'))
										 <p class="no-margin fs-12" >
										<i style="width:10px!important"class="material-icons mdl-list__item-icon fs-12 no-margin">location_on</i>{{$friend->get('location')}}</p>
									</div>
									@endif	
								   
							
							</td>
							<td class="mdl-data-table__cell--non-numeric">
								{{$friend->get('statuses_count')}} 
							</td>
							 <td class="mdl-data-table__cell--non-numeric">
								 {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$friend->get('created_at'))->diffInDays(now())}} day(s) ago
								</td>
								<td class="mdl-data-table__cell--non-numeric">
								 {{round($friend->get('statuses_count')/(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$friend->get('created_at'))->diffInDays(now())),2)}} tweets by day
								</td>
							  <td class="mdl-data-table__cell--non-numeric">
								 {{$friend->get('friends_count')}} 
								</td>
								 <td class="mdl-data-table__cell--non-numeric">
								 {{$friend ->get('followers_count')}} 
								</td>
					   
						
							<td class="mdl-data-table__cell--non-numeric ">

									
					 
					  {!! Form::open(array('class' => 'inline-block', 'id' => $social->id, 'friend_id'=>$friend->get('id'),  'method' => 'POST', 'route' => array('twitter.unfollow', $social->id,$friend->get('id') ))) !!}
   
					<button type="submit" class="dialog-button-save mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
							{{__('twitter.unfollow')}}</button>
							
									
						{!! Form::close() !!}

								{{-- White List ICON BUTTON --}}   
						{!! Form::open(array('class' => 'inline-block', 'id' => $social->id,  'method' => 'POST', 'route' => array('twitter.addwhitelist', $social->id ))) !!}
                                  <input type="hidden" name="friend" value={{base64_encode(json_encode($friend))}}>
			                      <button id="white.{{$friend->get('id')}}" type="submit"  style="min-width: 0px;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color-text--white  mdl-color--teal-300">
						   	      <i  class="material-icons">security</i></button>
									<span class="mdl-tooltip mdl-tooltip--large" for="white.{{$friend->get('id')}}">
									        {{__('twitter.white_list')}}
									        </span>
			
																
										{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
			  </tbody>
			</table>
		   @endif
		</div>
	</div>
	<div class="mdl-card__menu" style="top: -4px;">

		@include('partials.mdl-highlighter')

		@include('partials.mdl-search')


	</div>
</div>
@include('dialogs.dialog-delete')
	

@endsection

@section('footer_scripts')
	@include('scripts.highlighter-script')
	@include('scripts.mdl-datatables')


   
@endsection