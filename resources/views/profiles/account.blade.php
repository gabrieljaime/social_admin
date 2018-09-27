@extends('layouts.dashboard')

@section('template_title')
	{{ $user->name }}'s Account
@endsection

@section('template_fastload_css')
@endsection

@section('header')
	<small>
		{{ trans('profile.accountTitle',['username' => $user->name]) }}
	</small>
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

	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active">
		<a itemprop="item" href="{{ url('/account/') }}" class="hidden">
			<span itemprop="name">
				{{ trans('titles.account') }}
			</span>
		</a>
		{{ trans('titles.account') }}
		<meta itemprop="position" content="2" />
	</li>

@endsection

@section('content')

<div class="mdl-card mdl-shadow--2dp mdl-cell margin-top-0-tablet-important mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-desktop weather-container">
    <div class="mdl-card__title mdl-color--primary mdl-color-text--white header-container">
        <h2 class="mdl-card__title-text">
        	<span class="header-title">
				{{ trans('profile.changePwTitle') }}
        	</span>
        </h2>
    </div>

    <div class="mdl-card__supporting-text margin-top-0 padding-top-0">

		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">

			<div class="mdl-tabs__tab-bar">
				<a href="#name-panel" class="mdl-tabs__tab acct-tab is-active">{{ trans('profile.editAccountAdminTitle') }}</a>
				<a href="#change-panel" class="mdl-tabs__tab pw-tab">{{ trans('profile.changePwPill') }}</a>
				<a href="#delete-panel" class="mdl-tabs__tab del-tab">{{ trans('profile.deleteAccountPill') }}</a>
				<a href="#subscription-panel" class="mdl-tabs__tab sub-tab">Subspcription</a>
			</div>

		<div class="mdl-tabs__panel is-active" id="name-panel">



        	{!! Form::open(array('action' => 'UsersManagementController@store', 'method' => 'POST', 'role' => 'form')) !!}

						<div class="mdl-card__supporting-text">
							<div class="mdl-grid full-grid padding-0">
								<div class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--12-col-desktop">

									<div class="mdl-grid ">

										<div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('name') ? 'is-invalid' :'' }}">
												{!! Form::text('name', $user->name, array('id' => 'name', 'class' => 'mdl-textfield__input', 'pattern' => '[A-Z,a-z,0-9]*')) !!}
												{!! Form::label('name', trans('auth.name') , array('class' => 'mdl-textfield__label')); !!}
												<span class="mdl-textfield__error">Letters and numbers only</span>
											</div>
										</div>

										<div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('email') ? 'is-invalid' :'' }}">
												{!! Form::email('email', $user->email, array('id' => 'email', 'class' => 'mdl-textfield__input')) !!}
												{!! Form::label('email', trans('auth.email') , array('class' => 'mdl-textfield__label')); !!}
												<span class="mdl-textfield__error">Please Enter a Valid {{ trans('auth.email') }}</span>
											</div>
										</div>



									</div>
								</div>

							</div>
						</div>

						<div class="mdl-card__actions padding-top-0">
							<div class="mdl-grid padding-top-0">
								<div class="mdl-cell mdl-cell--12-col padding-top-0 margin-top-0 margin-left-1-1">

									{{-- SAVE BUTTON--}}
									<span class="save-actions">
										{!! Form::button('<i class="material-icons">save</i> Save New User', array('class' => 'dialog-button-save mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--green mdl-color-text--white mdl-button--raised margin-bottom-1 margin-top-1 margin-top-0-desktop margin-right-1 padding-left-1 padding-right-1 ')) !!}
									</span>

								</div>
							</div>
						</div>

							<div class="mdl-card__menu mdl-color-text--white">

								<span class="save-actions">
									{!! Form::button('<i class="material-icons">save</i>', array('class' => 'dialog-button-icon-save mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect', 'title' => 'Save New User')) !!}
								</span>

								<a href="{{ url('/users/') }}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-color-text--white" title="Back to Users">
										<i class="material-icons">reply</i>
										<span class="sr-only">Back to Users</span>
								</a>

							</div>

							@include('dialogs.dialog-save')

          {!! Form::close() !!}



		</div>

			<div class="mdl-tabs__panel" id="change-panel">


        {!! Form::open(array('action' => 'UsersManagementController@store', 'method' => 'POST', 'role' => 'form')) !!}

				<div class="mdl-card__supporting-text">
					<div class="mdl-grid full-grid padding-0">
					<div class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--12-col-desktop">

						<div class="mdl-grid ">

						<div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('password') ? 'is-invalid' :'' }}">
								{!! Form::password('password', array('id' => 'password', 'class' => 'mdl-textfield__input')) !!}
								{!! Form::label('password', 'Password', array('class' => 'mdl-textfield__label')); !!}
								<span class="mdl-textfield__error">Please enter a valid password</span>
							</div>
						</div>

						<div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('password_confirmation') ? 'is-invalid' :'' }}">
								{!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'mdl-textfield__input')) !!}
								{!! Form::label('password_confirmation', 'Confirm Password', array('class' => 'mdl-textfield__label')); !!}
								<span class="mdl-textfield__error">Must match password</span>
							</div>
						</div>


						</div>
					</div>

					</div>
				</div>

				<div class="mdl-card__actions padding-top-0">
					<div class="mdl-grid padding-top-0">
					<div class="mdl-cell mdl-cell--12-col padding-top-0 margin-top-0 margin-left-1-1">

						{{-- SAVE BUTTON--}}
						<span class="save-actions">
						{!! Form::button('<i class="material-icons">save</i> Save New User', array('class' => ' mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--green mdl-color-text--white mdl-button--raised margin-bottom-1 margin-top-1 margin-top-0-desktop margin-right-1 padding-left-1 padding-right-1 ')) !!}
						</span>

					</div>
					</div>
				</div>

					<div class="mdl-card__menu mdl-color-text--white">

					<span class="save-actions">
						{!! Form::button('<i class="material-icons">save</i>', array('class' => 'dialog-button-icon-save mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect', 'title' => 'Save New User')) !!}
					</span>

					<a href="{{ url('/users/') }}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-color-text--white" title="Back to Users">
						<i class="material-icons">reply</i>
						<span class="sr-only">Back to Users</span>
					</a>

					</div>

					{{-- @include('dialogs.dialog-save') --}}

          {!! Form::close() !!}


			</div>




			<div class="mdl-tabs__panel" id="delete-panel">
				{!! Form::model($user, array('action' => array('ProfilesController@deleteUserAccount', $user->id), 'method' => 'DELETE','role' => 'form'))!!}
				
					<div class="mdl-card__supporting-text">
						<div class="mdl-grid full-grid padding-0">

							
							<div class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
								<h6>
									<strong>Deleting</strong> your account is <u><strong>permanent</strong></u> and <u><strong>cannot</strong></u> be undone.
									<i class="material-icons mdl-color-text--red ">warning</i>
								</h6>

								<div class="mdl-grid ">
					
									<div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('checkConfirmDelete') ? 'is-invalid' :'' }}">

											<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkConfirmDelete">
												<input type="checkbox" name='checkConfirmDelete' id="checkConfirmDelete"class="mdl-checkbox__input" unchecked >
												<span class="mdl-checkbox__label">Confirm Account Deletion</span>
											</label>				
																					

										</div>
									</div>
					
					
								</div>
							</div>
					
						</div>
					</div>
					
					<div class="mdl-card__actions padding-top-0">
						<div class="mdl-grid padding-top-0">
							<div class="mdl-cell mdl-cell--12-col padding-top-0 margin-top-0 margin-left-1-1">
					
								{{-- SAVE BUTTON--}}
								<span class="delete-actions">
									{!! Form::button('<i class="material-icons">delete_forever</i> Delete User Account', array('disabled','class' => 'dialog-button-delete mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--grey mdl-color-text--white mdl-button--raised margin-bottom-1 margin-top-1 margin-top-0-desktop margin-right-1 padding-left-1 padding-right-1 ')) !!}
								</span>
					
							</div>
						</div>
					</div>
					
					<div class="mdl-card__menu mdl-color-text--white">
					
					
						<a href="{{ url('/users/') }}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-color-text--white"
						title="Back to Users">
														<i class="material-icons">reply</i>
														<span class="sr-only">Back to Users</span>
												</a>
					
					</div>
					@include('dialogs.dialog-delete') 
				{!! Form::close() !!}
			</div>

	  		<div class="mdl-tabs__panel" id="subscription-panel">
			
				{!! Form::open( array('action' => array('SubscriptionController@change'), 'method' => 'POST','role' => 'form', 'id'=>'change'))!!}
					<div class="mdl-card__supporting-text padding-0">
						<div class="mdl-grid full-grid padding-0">

							
							<div class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
								<h5 style="padding:5px; margin:0px">
								Your Subscription Plan:
								@if ($user->subscribed('main'))
									@if ( is_null($user->subscrip->first()->ends_at))
										<span class="mdl-chip mdl-color--green ">							
											<span class="mdl-chip__text mdl-color-text--white" style="font-size:14px">

												{{substr($user_plan, 0, strlen($user_plan)-2)}}
							
												@if (substr($user_plan, -2)=='_y') Yearly @else Monthly @endif

											</span>
										</span>
									@else	
										<span class="mdl-chip mdl-color--orange ">							
											<span class="mdl-chip__text mdl-color-text--white" style="font-size:13px">
												
												<strong> Canceled — Access Expires {{ $user->subscrip->first()->ends_at->diffForHumans()}} </strong>

											</span>
										</span>
									
									@endif
								@else 
									<span class="mdl-chip mdl-color--green ">							
										<span class="mdl-chip__text mdl-color-text--white" style="font-size:14px">

											{{$user_plan}}


										</span>
									</span>
								@endif

							
								</h5>

							 	<h6>Want to Modify Your Subscription?</h6>
								@if ($user->subscribed('main'))
					
									<div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
										<div class="mdl-dialog__actions block padding-1-half" style="padding-bottom:0px">
											<h6 style="margin-top: 5px;"> You have to select a plan </h6>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-select mdl-select__fullwidth {{ $errors->has('social_id') ? 'is-invalid' :'' }}">	
												<select class="mdl-selectfield__select mdl-textfield__input" name="subscription_plan" id="subscription_plan">
													<option value=""></option>
													@foreach ($plansNoFree as $plan )
													<option @isset($user_plan) @if ($user_plan==$plan->name.'_m') selected @endif @endisset value="{{$plan->stripe_id_m}}">{{$plan->name}} Monthly (${{$plan->price_m}})</option>
													<option @isset($user_plan) @if ($user_plan==$plan->name.'_y') selected @endif @endisset value="{{$plan->stripe_id_y}}">{{$plan->name}} Yearly (${{$plan->price_y}})</option>
													@endforeach
												
												</select>
												<label for="subscription_plan">
												<i class="mdl-icon-toggle__label material-icons">arrow_drop_down</i>
												</label>
										
											</div>	
										</div>
						
						
									</div>
								@endif
					
							</div>
						</div>
					</div>
					
					<div class="mdl-card__actions padding-top-0">
						<div class="mdl-grid padding-top-0">
							<div class="mdl-cell mdl-cell--4-col padding-top-0 margin-top-0 margin-left-1-1">
						
							@if ($user->subscribed('main'))
								{{-- SAVE BUTTON--}}
							<span class="change-actions">
									{!! Form::button('<i class="material-icons">cached</i> Update Plan', array('class' => 'dialog-button-change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--green mdl-color-text--white mdl-button--raised margin-bottom-1 margin-top-1 margin-top-0-desktop margin-right-1 padding-left-1 padding-right-1 ')) !!}
								</span>
								@include('dialogs.dialog-change_plan')
							@else 
							<a href="{{route('subscription')}}" class="change-actions">
									{!! Form::button('<i class="material-icons">cached</i> Subscribe', array('class' => ' mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--green mdl-color-text--white mdl-button--raised margin-bottom-1 margin-top-1 margin-top-0-desktop margin-right-1 padding-left-1 padding-right-1 ')) !!}
								</a>
							@endif
							
				{!! Form::close() !!}			
							</div>	

					@if ($user->subscribed('main'))		
						<div class="mdl-cell mdl-cell--2-col padding-top-0 margin-top-0 margin-left-1-1 " style="text-align: right;">		
								<h6>Or</h6>
						</div>	
						@if  ($user->subscrip->first()->ends_at)	
							<div class="padding-top-0 margin-top-0 margin-left-1-1">		
									<span class="resume-actions">
											{!! Form::button('<i class="material-icons">restore</i> Resume your Subscription', array('class' => 'dialog-button-resume mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--orange mdl-color-text--white mdl-button--raised margin-bottom-1 margin-top-1 margin-top-0-desktop margin-right-1 padding-left-1 padding-right-1 ')) !!}
									</span>
						
								</div>
							</div>

						@include('dialogs.dialog-resume')
					
						@else	
							<div class="padding-top-0 margin-top-0 margin-left-1-1">		
									<span class="delete-actions">
											{!! Form::button('<i class="material-icons">not_interested</i> UnSubscribe', array('class' => 'dialog-button-unsubscribe mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--red mdl-color-text--white mdl-button--raised margin-bottom-1 margin-top-1 margin-top-0-desktop margin-right-1 padding-left-1 padding-right-1 ')) !!}
									</span>
						
								</div>
							</div>
							
							@include('dialogs.dialog-unsubscribre')
					
						@endif
					@endif	
					</div>
				

					<div class="mdl-card__menu mdl-color-text--white">
					
					
						<a href="{{ url('/users/') }}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-color-text--white"
						title="Back to Users">
														<i class="material-icons">reply</i>
														<span class="sr-only">Back to Users</span>
												</a>
					
					</div>
				
			
			</div>

		</div>

    </div>




</div>


	<style type="text/css" media="screen">
		.header-container {

		}
		.account-header-password {

		}
		.account-header-delete {
			display: none;
		}
	</style>
@endsection
@section('footer_scripts')
	<script>
   mdl_dialog('.dialog-button-delete','.dialog-delete-close','#dialog_delete');
   mdl_dialog('.dialog-button-change','.dialog-change-close','#dialog_change');
   @if ($user->subscribed('main') && ($user->subscrip->first()->ends_at))
	mdl_dialog('.dialog-button-resume','.dialog-resume-close','#dialog_resume');
@else
mdl_dialog('.dialog-button-unsubscribe','.dialog-unsubscribe-close','#dialog_unsubscribe');

@endif
 //  mdl_dialog('.dialog-button-save');

	 
		$(document).ready(function() {


			 $('#checkConfirmDelete').change(function() { 
					if(this.checked) {
								$('.dialog-button-delete').prop('disabled', false);		
								$('.dialog-button-delete').removeClass('mdl-color--grey'); 
								$('.dialog-button-delete').addClass('mdl-color--red');			
							}
						else {
					$('.dialog-button-delete').prop('disabled', true);
					$('.dialog-button-delete').addClass('mdl-color--grey'); 
					$('.dialog-button-delete').removeClass('mdl-color--red');
						
						}
				});

			function tabHeaders() {
				var titleContainer = $('.header-container');
				var titleContent = $('.header-title');
				var trigger = $('.mdl-tabs__tab');
				var delTriggerClass = 'del-tab';
				var pwTriggerClass = 'pw-tab';
				var subTriggerClass = 'sub-tab';
				var deleteClass = "mdl-color--red-400";
				var pwClass = "mdl-color--yellow-800";
				var defaultClass = "mdl-color--primary";
				var subsClass = "mdl-color--green";
				var activeClass = "is-active";
				var title;

				trigger.click(function() {

					var self = $(this);
					title = self.text();


					titleContainer.removeClass(defaultClass + ' ' + deleteClass + ' ' + pwClass + ' ' + subsClass);

				    switch (true) {
				      case self.hasClass(delTriggerClass):
				        titleContainer.addClass(deleteClass);
				        break;
				      case self.hasClass(pwTriggerClass):
				        titleContainer.addClass(pwClass);
				        break;
							case self.hasClass(subTriggerClass):
				        titleContainer.addClass(subsClass);
				        break;
				      default:
						titleContainer.addClass(defaultClass);
				        break;
				    }
					titleContent.html(title);
				});
			}
			tabHeaders();
		});

	</script>


@endsection
