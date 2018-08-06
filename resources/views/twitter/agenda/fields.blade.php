<div class="mdl-card__supporting-text">
    <div class="mdl-grid full-grid padding-0">
        <div class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
            <div class="mdl-grid ">
              @isset($agenda->social->user->name)
              <div class="mdl-cell mdl-cell--6-col-tablet mdl-cell--6-col-desktop " >
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('user_id') ? 'is-invalid' :'' }}">
                      {!! Form::text('user_id',    $agenda->social->user->name  , array('id' => 'user_id', 'class' => 'mdl-textfield__input', 'disabled')) !!}
                      {!! Form::label('user_id', 'Agended By' , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Letters and numbers only</span>
                    </div>
                  </div>
             @endisset
              <div class="mdl-cell mdl-cell--6-col-tablet mdl-cell--6-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-select mdl-select__fullwidth {{ $errors->has('social_id') ? 'is-invalid' :'' }}">
                      <select class="mdl-selectfield__select mdl-textfield__input" name="social_id" id="social_id">
                        <option value=""></option>
                        @if ($socials->count())
                          @foreach($socials as $social)
                            <option  @isset($agenda) @if ($agenda->social_id===$social->id)selected @endif @endisset value="{{ $social->id }}">{{'@'.$social->social_name }}</option>
                          @endforeach
                        @endif
                      </select>
                      <label for="role">
                          <i class="mdl-icon-toggle__label material-icons">arrow_drop_down</i>
                      </label>
                      {!! Form::label('social_id','Publishing Account', array('class' => 'mdl-textfield__label mdl-selectfield__label')); !!}
                      <span class="mdl-textfield__error">Select an Account to agend a twitt</span>
                    </div>
              </div>

              <div class="mdl-cell mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('name') ? 'is-invalid' :'' }}">
                      {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'mdl-textfield__input')) !!}
                      {!! Form::label('name', 'Name' , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Letters and numbers only</span>
                    </div>
                  </div>
              <div class="mdl-cell mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('text') ? 'is-invalid' :'' }}">
                      {!! Form::textarea('text', NULL, array('id' => 'text','rows'=>'3', 'class' => 'mdl-textfield__input')); !!}
                      {!! Form::label('text', 'Content' , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Letters and numbers only</span>
                    </div>
                    
                
              </div>
              <div class="mdl-cell mdl-cell--6-col-tablet mdl-cell--3-col-desktop">
                  
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty is-upgraded  {{ $errors->has('image') ? 'is-invalid' :'' }}">
                        {!! Form::label('image', 'Image' , array('class' => 'mdl-textfield__label ')); !!}
                    
                     @if(isset($agenda->image))
                      <div style="padding-top:10px">
                       {!!cl_image_tag(Cloudder::show("v".$agenda->image."/twitter/".$agenda->social_id."/".$agenda->id,array("width"=>200,  "fetch_format"=>"auto", "crop"=>"scale")), array('id'=>'image-file'))!!}
                      </div>
                      @else
                       <div style="padding-top:10px">
                       <img src="" id="image-file" style="widht:200px">
                      </div>
                    @endif 

                    
                           <input type="file" id="image" name="image" onchange="readURL(this);" style="visibility:collapse">
                          <label for="image" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored" style="margin-left: -40px;">
                          <i class="material-icons">cloud_upload</i>
                          </label>
                      </div>

                  </div>
                
      
                    
                  
                   <div class="mdl-cell mdl-cell--6-col-tablet mdl-cell--9-col-desktop">
                     <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('link') ? 'is-invalid' :'' }}">
                     {!! Form::text('link', NULL, array('id' => 'link', 'class' => 'mdl-textfield__input', )) !!}
                     {!! Form::label('link', 'Url Link' , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Letters and numbers only</span>
                    </div>
                  </div>  


                   <div class="mdl-card__actions padding-top-0">
                 
                    <div class="mdl-cell mdl-cell--12-col ">


       
                    @if (!$edit)

                      {{-- SAVE BUTTON--}}
                      <span class="save-actions">
                      <button  onClick='now()' class="dialog-button-tweet mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--green mdl-color-text--white mdl-button--raised margin-bottom-1 margin-top-1 margin-top-0-desktop margin-right-1 padding-left-1 padding-right-1 " type="button" data-upgraded=",MaterialButton,MaterialRipple">
                        @include('twitter.icon', ['class' => 'twitter-icon__white']) Tweet Now!
                        <span class="mdl-button__ripple-container">
                        <span class="mdl-ripple is-animating" style="width: 230.633px; height: 230.633px; transform: translate(-50%, -50%) translate(93px, 30px);"></span>
                      </span>
                      </button>
                      
                      </span>
                    @endif
                 
                     </div>
                 </div>
                   <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--4-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty is-upgraded {{ $errors->has('publication_date') ? 'is-invalid' :'' }}">
                      {!! Form::date('publication_date', NULL, array('id' => 'publication_date', 'class' => 'mdl-textfield__input', )) !!}
                      {!! Form::label('publication_date', 'Publishing On' , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Letters and numbers only</span>
                    </div>
                  </div>  
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--4-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty is-upgraded {{ $errors->has('publication_at') ? 'is-invalid' :'' }}">
                      {!! Form::time('publication_at', NULL, array('id' => 'publication_at', 'class' => 'mdl-textfield__input')) !!}
                      {!! Form::label('publication_at', 'Publishing At' , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Numbers only</span>
                    </div>
                  </div>  
                  <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--4-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('frequency') ? 'is-invalid' :'' }}">
                      {!! Form::number('frequency', NULL, array('id' => 'frequency', 'class' => 'mdl-textfield__input')) !!}
                      {!! Form::label('frequency', 'Frequency ' , array('class' => 'mdl-textfield__label')); !!}
                      <span class="mdl-textfield__error">Numbers only</span>
                    </div>
                  </div> 
                  

                  <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                    <div class="mdl-textfield mdl-js-textfield  {{ $errors->has('active') ? 'is-invalid' :'' }}">
                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="active">
                        <input name="active" type="checkbox" id="active" class="mdl-switch__input" @isset($agenda) @if ($agenda->active===1)checked @endif @endisset  }}  >

                        
                        <span class="mdl-switch__label">Active</span>
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
                <span class="save-actions">
                  {!! Form::button('<i class="material-icons">alarm</i>Plan It', array('onClick'=>'schedule()','class' => 'dialog-button-save mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--green mdl-color-text--white mdl-button--raised margin-bottom-1 margin-top-1 margin-top-0-desktop margin-right-1 padding-left-1 padding-right-1 ')) !!}
                </span>

              </div>
            </div>
          </div>

            <div class="mdl-card__menu mdl-color-text--white">

              <span class="save-actions">
                {!! Form::button('<i class="material-icons">save</i>', array('class' => 'dialog-button-icon-save mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect', 'title' => 'Save Agenda')) !!}
              </span>
              <a href="{{ url('/twitter/agenda/') }}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-color-text--white" title="Back to Agenda">
                  <i class="material-icons">reply</i>
                  <span class="sr-only">Back to Agenda</span>
              </a>

            </div>

            @include('dialogs.tweet-save')
<script type="text/javascript">

  function schedule() {     
            $('#submitn').hide();
            $('#submits').show();
    };
  function now() {     
             $('#submitn').show();
             $('#submits').hide();
    };
     function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-file')
                        .attr('src', e.target.result)
                        .width(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

 


  </script>