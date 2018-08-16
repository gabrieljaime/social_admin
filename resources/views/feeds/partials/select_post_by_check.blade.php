<select class="mdl-selectfield__select mdl-textfield__input" name="post_by_check" id="post_by_check">
  <option value=""></option>
  <option @isset($feed) @if ($feed->term_to_check===1) selected @endif @endisset value="1">1</option>
  <option @isset($feed) @if ($feed->term_to_check===2) selected @endif @endisset value="2">2</option>
  <option @isset($feed) @if ($feed->term_to_check===3) selected @endif @endisset value="3">3</option>
  <option @isset($feed) @if ($feed->term_to_check===4) selected @endif @endisset value="4">4</option>
  <option @isset($feed) @if ($feed->term_to_check===5) selected @endif @endisset value="5">5</option>
</select>
<label for="post_by_check">
  <i class="mdl-icon-toggle__label material-icons">arrow_drop_down</i>
</label>
