@php
	$user = Auth::user();
	if ($user->profile->avatar_status == 1) {
		$userGravImage = $user->profile->avatar;
	} else {
		$userGravImage = Gravatar::get($user->email);
	}
@endphp
<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
	
	<a href="/" class="dashboard-logo mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--primary mdl-color-text--white">
		<img src="{{url('images/icon_s.png')}}" width="46px" > 
		 &nbsp;Social Admin
	</a>
	<header class="demo-drawer-header">
		<img id="drawer_avatar" src="{{ $userGravImage }}" alt="{{ Auth::user()->name }}" class="demo-avatar mdl-list__item-avatar">
		<span itemprop="image" style="display:none;">{{ Gravatar::get(Auth::user()->email) }}</span>
		<!-- <i class="material-icons mdl-list__item-avatar">face</i> -->
		<div class="demo-avatar-dropdown">
			<span>
				{{ Auth::user()->name }}&nbsp;
				
				<sup class="supidc">({{__('plans.'.Auth::user()->Plan()->name)}})</sup>


			</span>
			<div class="mdl-layout-spacer"></div>
			@include('partials.account-nav')
		</div>
	</header>
	<nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
		<a class="mdl-navigation__link {{ Request::is('/') ? 'mdl-navigation__link--current' : null }}" href="/" title="{{ Lang::get('titles.home') }}">
			<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>
			{{__('titles.home')}}
		</a>
		<a class="mdl-navigation__link {{ Request::is('profile/'.Auth::user()->name) ? 'mdl-navigation__link--current' : null }}" href="{{ url('/profile/'.Auth::user()->name) }}">
			<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">person</i>
			{{__('titles.profile')}}
		</a>
		<a class="mdl-navigation__link {{ Request::is('tasks') ? 'mdl-navigation__link--current' : null }}" href="/tasks">
			<i class="material-icons mdl-badge mdl-badge--overlap" @if (count($incompleteTasks) != 0) data-badge="{{ count($incompleteTasks) }}" @endif role="presentation">view_list</i>
			{{__('titles.task')}}
		</a>
		<a class="mdl-navigation__link {{ Request::is('tasks/create') ? 'mdl-navigation__link--current' : null }}" href="/tasks/create">
			<i class="material-icons mdl-badge mdl-badge--overlap" role="presentation">playlist_add</i>
			{{__('titles.create_task')}}
		</a>

		<a class="mdl-navigation__link {{ Request::is('feeds') ? 'mdl-navigation__link--current' : null }}" href="/feeds">
			<i class="material-icons mdl-badge mdl-badge--overlap" @if (count($activefeeds) != 0) data-badge="{{ count($activefeeds) }}" @endif role="presentation">rss_feed</i>
			{{__('titles.feeds')}}
		</a>
		<a class="mdl-navigation__link {{ Request::is('twitter') || Request::is('twitter/agenda') ? 'mdl-navigation__link--current' : null }}" href="/twitter">
			<i class="material-icons mdl-badge mdl-badge--overlap" @if (count($activeaccounts) != 0) data-badge="{{ count($activeaccounts) }}" @endif role="presentation">supervisor_account</i>
			{{__('titles.twitter_accounts')}}
		</a>
		<a class="mdl-navigation__link {{ Request::is('twitter/agenda')  ? 'mdl-navigation__link--current' : null }}" href="/twitter/agenda">
			<i class="material-icons mdl-badge mdl-badge--overlap" role="presentation">calendar_today</i>
			{{__('titles.twitter_agenda')}}
		</a>
		<a class="mdl-navigation__link {{ Request::is('twitter/tweets')  ? 'mdl-navigation__link--current' : null }}" href="/twitter/tweets">
		<i class="material-icons mdl-badge mdl-badge--overlap" role="presentation">send</i>
			{{__('titles.tweet_sent')}}
		</a>
		<a class="mdl-navigation__link {{ Request::is('twitter/whitelist')  ? 'mdl-navigation__link--current' : null }}" href="/twitter/whitelist/all">
		<i class="material-icons mdl-badge mdl-badge--overlap" role="presentation">security</i>
			{{__('titles.white_list')}}
		</a>

		@role('admin')
			<a class="mdl-navigation__link {{ (Request::is('users') || Request::is('users/create') || Request::is('users/deleted')) ? 'mdl-navigation__link--current' : null }}" href="{{ url('/users') }}">
				<i class="mdl-color-text--blue-grey-400 material-icons mdl-badge mdl-badge--overlap" data-badge="{{ $totalUsers }}" role="presentation">contacts</i>
				{{__('titles.adminUserList')}}
			</a>
			
				<a class="mdl-navigation__link {{ Request::is('users/create') ? 'mdl-navigation__link--current' : null }}" href="{{ url('/users/create') }}">
					<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">person_add</i>
					{{__('titles.adminNewUser')}}
				</a>
			
			<a class="mdl-navigation__link {{ Request::is('themes') ? 'mdl-navigation__link--current' : null }}" href="{{ url('/themes') }}">
				<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">invert_colors</i>
				{{__('titles.adminThemesList')}}
			</a>
			<a class="mdl-navigation__link {{ Request::is('logs') ? 'mdl-navigation__link--current' : null }}" href="{{ url('/logs') }}">
				<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">bug_report</i>
				{{__('titles.adminLogs')}}
			</a>
			<a class="mdl-navigation__link {{ Request::is('php') ? 'mdl-navigation__link--current' : null }}" href="{{ url('/php') }}">
				<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">info</i>
				{{__('titles.adminPHP')}}
			</a>
			<a class="mdl-navigation__link {{ Request::is('routes') ? 'mdl-navigation__link--current' : null }}" href="{{ url('/routes') }}">
				<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings_ethernet</i>
				{{__('titles.adminRoutes')}}
			</a>
		@endrole

		<div class="mdl-layout-spacer"></div>

		<a class="mdl-navigation__link" href="https://gabrieljaime.com" target="_blank">
			<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i>
			<span class="visuallyhidden">Help</span>
		</a>
	</nav>
</div>