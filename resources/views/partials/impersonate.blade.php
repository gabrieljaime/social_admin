@canImpersonate
	
	<li class="mdl-menu__item mdl-list__item">
		<i class="material-icons mdl-list__item-icon">supervisor_account</i>
		<select  class="" onchange="window.location=this.options[this.selectedIndex].value">
			    <option value=""></option>
			    @foreach (App\Models\User::where('id','<>', Auth::user()->id)->get() as $user)
				<option value="{{ route('impersonate', $user->id) }}">{{$user->name}}</option>
				@endforeach
		</select>
		
	</li>
	
	@endCanImpersonate
	
	@impersonating

	<li class="mdl-menu__item mdl-list__item">
		<a href="{{ route('impersonate.leave') }}">
			<span class="mdl-list__item-primary-content">
				<i class="material-icons mdl-list__item-icon">verified_user</i>
				Back To User
			</span>
		</a>
	</li>
	@endImpersonating
	