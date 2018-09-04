<select class="mdl-selectfield__select mdl-textfield__input" name="term_to_check" id="term_to_check">
  <option value=""></option>
  <option  @isset($feed) @if ($feed->term_to_check===15) selected @endif @endisset value="15">{{__('feed.term_to_check_15')}}</option>
  <option  @isset($feed) @if ($feed->term_to_check===30)  selected @endif @endisset value="30">{{__('feed.term_to_check_30')}}</option>
  <option  @isset($feed) @if ($feed->term_to_check===60) selected @endif @endisset value="60">{{__('feed.term_to_check_60')}}</option>
  <option  @isset($feed) @if ($feed->term_to_check===180) selected @endif @endisset value="180">{{__('feed.term_to_check_180')}}</option>
  <option  @isset($feed) @if ($feed->term_to_check===360) selected @endif @endisset value="360">{{__('feed.term_to_check_360')}}</option>
  <option  @isset($feed) @if ($feed->term_to_check===720) selected @endif @endisset value="720">{{__('feed.term_to_check_720')}}</option>
  <option  @isset($feed) @if ($feed->term_to_check===1440) selected @endif @endisset  value="1440">{{__('feed.term_to_check_1440')}}</option> 
</select>
<label for="term_to_check">
  <i class="mdl-icon-toggle__label material-icons">arrow_drop_down</i>
</label>