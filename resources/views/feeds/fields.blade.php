<div class="mdl-card__supporting-text">
    <div class="mdl-grid full-grid padding-0">
        <div class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
            <div class="mdl-grid ">
                <div class="mdl-cell mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('feed') ? 'is-invalid' :'' }}">
                      {!! Form::text('feed', NULL, array('id' => 'feed', 'class' => 'mdl-textfield__input')) !!}
                      {!! Form::label('feed', __('feed.feed') , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Letters and numbers only</span>
                    </div>
                  </div>
                <div class="mdl-cell mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('name') ? 'is-invalid' :'' }}">
                      {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'mdl-textfield__input')) !!}
                      {!! Form::label('name',__('feed.name') , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Letters and numbers only</span>
                    </div>
                </div>  
                   <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                     <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('begin') ? 'is-invalid' :'' }}">
                     {!! Form::text('begin', NULL, array('id' => 'begin', 'class' => 'mdl-textfield__input', )) !!}
                     {!! Form::label('begin', __('feed.begin') , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Letters and numbers only</span>
                    </div>
                  </div>  
                   <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('end') ? 'is-invalid' :'' }}">
                      {!! Form::text('end', NULL, array('id' => 'end', 'class' => 'mdl-textfield__input', )) !!}
                      {!! Form::label('end', __('feed.end') , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Letters and numbers only</span>
                    </div>
                  </div>  
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--4-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-select mdl-select__fullwidth  {{ $errors->has('term_to_check') ? 'is-invalid' :'' }}">

                      @include('feeds.partials.select_term_to_check') 

                      {!! Form::label('term_to_check', __('feed.term') , array('class' => 'mdl-textfield__label')); !!}
                    </div>
                  </div>  
                  <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--4-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-select mdl-select__fullwidth {{ $errors->has('post_by_check') ? 'is-invalid' :'' }}">
                     
                        @include('feeds.partials.select_post_by_check') 

                      {!! Form::label('post_by_check', __('feed.post') , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Numbers only</span>
                    </div>
                  </div> 
                  <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--4-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('daily_posts') ? 'is-invalid' :'' }}">
                      {!! Form::number('daily_posts', NULL, array('id' => 'daily_posts', 'class' => 'mdl-textfield__input', 'pattern' => '[0-99]*', 'max'=>'10', 'min'=>'1') )!!}
                      {!! Form::label('daily_posts',__('feed.daily') , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Numbers only less than 10</span>
                    </div>
                  </div> 

                  <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield  {{ $errors->has('shorten_url') ? 'is-invalid' :'' }}">
                      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="shorten_url">
                    <input  name=shorten_url  type="checkbox" id="shorten_url" class="mdl-switch__input" @isset($feed) {{ ($feed->shorten_url===1 || $feed->shorten_url) ? 'checked' : ''  }} @endisset >
                    <span class="mdl-switch__label">{{__('feed.shorten')}}</span>
                    </div>
                  </div> 

                  <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield  {{ $errors->has('active') ? 'is-invalid' :'' }}">
                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="active">
                        <input name="active" type="checkbox" id="active" class="mdl-switch__input"   @isset($feed){{ ($feed->active===1 || $feed->active) ? 'checked' : ''  }} @endisset >

                        
                        <span class="mdl-switch__label">{{__('feed.active')}}</span>
                         </label>
                    </div>
                  </div> 
                  
                  <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-select mdl-select__fullwidth {{ $errors->has('social_id') ? 'is-invalid' :'' }}">
                      <select class="mdl-selectfield__select mdl-textfield__input" name="social_id" id="social_id">
                        <option value=""></option>
                        @if ($socials->count())
                          @foreach($socials as $social)
                            <option  @isset($feed) @if ($feed->social_id===$social->id)selected @endif @endisset value="{{ $social->id }}">{{'@'.$social->social_name }}</option>
                          @endforeach
                        @endif
                      </select>
                      <label for="social_id">
                          <i class="mdl-icon-toggle__label material-icons">arrow_drop_down</i>
                      </label>
                      {!! Form::label('social_id',__('feed.assigned'), array('class' => 'mdl-textfield__label mdl-selectfield__label')); !!}
                      <span class="mdl-textfield__error">{{__('feed.select_account')}}</span>
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
                  {!! Form::button('<i class="material-icons">save</i>'.__('profile.submitButton'), array('class' => 'dialog-button-save mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--green mdl-color-text--white mdl-button--raised margin-bottom-1 margin-top-1 margin-top-0-desktop margin-right-1 padding-left-1 padding-right-1 ')) !!}
                </span>

              </div>
            </div>
          </div>

            <div class="mdl-card__menu mdl-color-text--white">

              <span class="save-actions">
                {!! Form::button('<i class="material-icons">save</i>', array('class' => 'dialog-button-icon-save mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect', 'title' => __('profile.submitButton').' '.__('feed.feed'))) !!}
              </span>
              <a href="{{ url('/feeds/') }}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-color-text--white" title="{{__('feed.back')}}">
                  <i class="material-icons">reply</i>
                  <span class="sr-only">{{__('feed.back')}}</span>
              </a>

            </div>

            @include('dialogs.dialog-save') 