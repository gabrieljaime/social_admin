<a @if (count($twitters)<Auth::user()->Plan()->social)
        href="{{ route('social.redirect', ['provider' => 'twitter']) }}" 
        @else
        href="{{ route('subscription') }}"
        @endif 
        class="social-twitter " id="twitter">
              <i class="material-icons twitter-card-icon " @if (count($twitters)<Auth::user()->Plan()->social) @else style="color:red!important" @endif>
                @if (count($twitters)<Auth::user()->Plan()->social) add_circle @else error @endif </i>
            <svg viewBox="0 0 100 100" class="shape-twitter" style="fill:white!important">
                
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#shape-twitter"></use>
            </svg>
            <span>Twitter</span>
            <span class="mdl-tooltip mdl-tooltip--top" for="twitter">
          @if (count($twitters)<Auth::user()->Plan()->social)
          {{__('twitter.add_tolltip')}}
          @else 
          Upgrade your plan for more accounts
          @endif
            </span>
</a>