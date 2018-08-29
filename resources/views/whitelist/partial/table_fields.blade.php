@foreach ( $social->whitelist as $whitelist )
  <tr  id='row_{{$whitelist->id}}'>
		<td class="mdl-data-table__cell--non-numeric" style="padding: 1em .5em;" >
			<div class="left">		
					<img  id="{{$social->id}}"  src="{{$social->image}}" alt="{{$social->social_name}}"  class="user-avatar-twitt-list">
			</div> 
			<div class="name-twitter">
				<p class="no-margin fs-12 ">
					<span class="bold"> {{$social->name}}		  				
								<br>			
								<span class="semi-bold">
									<a href="{{ URL::to('twitter/' . $social->id) }}">{{'@'.$social->social_name}}
									</a>
								</span>
					</span>
				</p>
			</div> 
			
		</td>
		<td class="mdl-data-table__cell--non-numeric">
			<div class="left">		
				<img  id="{{$whitelist->id}}"  src="{{$whitelist->profile_image_url}}" alt="{{$whitelist->screen_name}}"  class="user-avatar-twitt-list">
			</div>
			<div class="name-twitter">		
				<p class="no-margin fs-12 ">	
					<span class="bold"> {{$whitelist->name}}
						@if ($whitelist->verified)
							<i class="check-twitter material-icons fs-12" aria-hidden="true">check_circle</i>
						@endif 
						
						<br>			
						<span class="semi-bold">
							<a href="https://twitter.com/{{'@'.$whitelist->screen_name}}" tar="_blank"> {{'@'.$whitelist->screen_name}}</a>
						</span>		
					</span>
				</p>	
				@if ($whitelist->location)
					<p class="no-margin fs-12" >
						<i style="width:10px!important"class="material-icons mdl-list__item-icon fs-12 no-margin">location_on</i>{{$whitelist->location}}
					</p>
			
				@endif	
			</div> 
		
		</td>  
		<td class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">{{ $whitelist->created_at->format('d/m/Y H:i:s')}}</td>
		<td class="mdl-data-table__cell--non-numeric">
			{{-- DELETE ICON BUTTON AND FORM CALL --}}  
				{!! Form::open(array('class' => 'inline-block', 'id' => 'delete_'.$whitelist->id, 'method' => 'DELETE', 'route' => array('twitter.whitelist.delete', $whitelist->id))) !!}
				{{ method_field('DELETE') }}
				<a href="#" class="dialog-button dialiog-trigger-delete dialiog-trigger{{$whitelist->id}} mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" data-whitelistid="{{$whitelist->id}}">
					<i class="material-icons mdl-color-text--red    ">delete</i>
					<span class="sr-only">Delete Friend from White List</span>
				</a>
			{!! Form::close() !!}
		</td>
  </tr> 
@endforeach