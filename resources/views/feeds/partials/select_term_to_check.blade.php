<select class="mdl-selectfield__select mdl-textfield__input" name="term_to_check" id="term_to_check">
  <option value=""></option>
  <option  @isset($feed) @if ($feed->term_to_check===15) selected @endif @endisset value="15">Every 15 Minutes</option>
  <option  @isset($feed) @if ($feed->term_to_check===30)  selected @endif @endisset value="30">Every 30 Minutes</option>
  <option  @isset($feed) @if ($feed->term_to_check===60) selected @endif @endisset value="60">Every hour</option>
  <option  @isset($feed) @if ($feed->term_to_check===180) selected @endif @endisset value="180">Every 3 hours</option>
  <option  @isset($feed) @if ($feed->term_to_check===360) selected @endif @endisset value="360">Every 6 hours</option>
  <option  @isset($feed) @if ($feed->term_to_check===720) selected @endif @endisset value="720">Every 12 hours</option>
  <option  @isset($feed) @if ($feed->term_to_check===1440) selected @endif @endisset  value="1440">Once a day</option> 
</select>
<label for="term_to_check">
  <i class="mdl-icon-toggle__label material-icons">arrow_drop_down</i>
</label>