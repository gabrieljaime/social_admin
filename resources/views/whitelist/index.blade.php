@extends('layouts.dashboard')

@section('template_title')
  Showing WhiteList
@endsection

@section('template_linked_css')
@endsection

@section('header')



  White List  @isset($social) of {{'@'.$social->social_name }} @endisset

  
@endsection

@php
	$enableDataTablesCount = 50;
@endphp

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
	@isset($social)
	 <li  itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
	 <a itemprop="item" href="/twitter/{{ $social->id }}" >
			<span itemprop="name">
			   {{'@'.$social->social_name}}
			</span>
		</a>
		 <i class="material-icons">chevron_right</i>
		<meta itemprop="position" content="3" />
	</li>
	@endisset
	 <li  itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
	 <a class="active" itemprop="item"  disabled>
			<span itemprop="name">
			  White List
			</span>
		</a>
		<meta itemprop="position" content="4" />
	</li>
@endsection

@section('template-form-status')
	@include('partials.form-status-ajax')
@endsection

@section('content')

<div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell--12-col-desktop margin-top-0">
	<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
		<h2 class="mdl-card__title-text logo-style">
			@isset($social)
			   @if (count($social->whitelist) === 1)
			   {{ count($social->whitelist) }} White List Account
			   @elseif (count($social->whitelist) > 1)
			   	{{ count($social->whitelist) }}  White List Accounts
			   @else
			   	White List Accounts :(
			   @endif   
			@endisset
			@isset($socials)
				White List of Account 
			@endisset
		</h2>

	</div>
	<div class="mdl-card__supporting-text mdl-color-text--grey-600 padding-0 context">
		<div class="table-responsive material-table">
			<table id="whitelist_table" class="mdl-data-table mdl-js-data-table data-table" cellspacing="0" width="100%">
			  <thead>
				<tr>
					<th class="mdl-data-table__cell--non-numeric">Social Account</th>
					<th class="mdl-data-table__cell--non-numeric">Friend</th>
					<th class="mdl-data-table__cell--non-numeric">Created At</th>
					<th class="mdl-data-table__cell--non-numeric no-sort no-search">Actions</th>
				</tr>
			  </thead>
			  <tbody>
				  @isset($socials)

				 
					@foreach ($socials as $social)
							 @include('whitelist.partial.table_fields')
					@endforeach
				@else	
				 @include('whitelist.partial.table_fields')
				 	
				 @endisset
			
			
			  </tbody>
			</table>
		</div>
	</div>
	<div class="mdl-card__menu" style="top: -4px;">

		@include('partials.mdl-highlighter')

		@include('partials.mdl-search')

		
	</div>
</div>

@include('dialogs.dialog-delete', ['isAjax' => true,'dialogTitle'=>'Delete White List', 'dialogSaveBtnText'=> 'Confirm', 'dialogSubTitle'=>'You will delete that friend from White List' ])


@endsection

@section('footer_scripts')
	@include('scripts.highlighter-script')
	@include('scripts.mdl-datatables')
   
<script type="text/javascript">

@isset($socials) 
	@foreach ($socials as $social)
		@foreach ($social->whitelist as $whitelist)
			mdl_dialog('.dialiog-trigger{{$whitelist->id}}','','#dialog_delete');
		@endforeach	
	@endforeach 
@else
	@foreach ($social->whitelist as $whitelist) 
		mdl_dialog('.dialiog-trigger{{$whitelist->id}}','','#dialog_delete');
	@endforeach
@endisset

			var whitelistId;

			$('.dialiog-trigger-delete').click(function(event) {
				event.preventDefault();
				whitelistId = $(this).attr('data-whitelistid');
			});

	$('#confirm').click(function(event) {
		var dialog = document.querySelector('dialog');
		var token ='{{csrf_token()}}';
		var table= $('#whitelist_table').DataTable();
		$('#confirm .mdl-spinner-text').fadeOut(1, function() {
	  	$('#confirm .mdl-spinner').addClass('is-active'); });
		var fadeSpeed = 150;
		var dataId =  whitelistId;
		$.ajax({
			url: '{{ url('twitter/whitelist/delete')}}',
			type: "post",
			dataType: 'json',
			data: {'id':dataId,_method: 'delete', _token :token},
			success: function(request, status, data){
				dialog.close();
					$('#confirm .mdl-spinner-text').fadeIn(1, function() {
	        	$('#confirm .mdl-spinner').removeClass('is-active'); });
				$('#ajax_message_title').text(request.title);
				$('#ajax_message_message').text(request.message);
				$('#ajax_message_icon').text('check');
				$('.message.ajax-message').addClass('success')
				$('.message.ajax-message').fadeIn(fadeSpeed, function() {
					$(this).css({
						opacity: 1,
						left: 0
					});
				});
				table.row('#row_'+dataId).remove().draw( false );

			},
			error: function (request, status, error) {
				console.log(error);
				console.log(request);
				console.log(status);
				dialog.close();
				$('#ajax_error_message').text(request.responseText);
				$('.ajax-error.message').fadeIn(fadeSpeed, function() {
					$(this).css({
						opacity: 1,
						left: 0
					});
				});;
			}
		});
			});



	$.ajaxSetup({
	   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	});


</script>
@endsection