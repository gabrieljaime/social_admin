<div class="mdl-shadow--2dp mdl-cell margin-top-0-tablet-important mdl-cell--6-col mdl-cell--6-col-tablet mdl-cell--4-col-desktop tweet" >

    <div class="mdl-card__supporting-text  mdl-color-text--black">
        <img src="{{$tweet->social->image}}" alt="{{$tweet->social->social_name}}" class="user-avatar-tweet mdl-shadow--4dp" >
        <span class="mdl-card__title-text mdl-card__title-text-twitt" style="margin:0px 0px 5px 55px"> 
        <br> <strong class="tweet-fullname"> {{$tweet->social->name}}</strong>
              <a  style="font-size:14px;color:#{{$tweet->social->color}}">  
                  {{'@'.$tweet->social->social_name}}
              </a>
              <small class="tweet-time">
                 <a href="https://twitter.com/{{$tweet->social->social_name}}/status/{{$tweet->twitt_id}}" target="_blank" class="tweet-time">
                 
                  {{$tweet->created_at->diffForHumans(now()) }} 
                    
                   
                </a>
             </small> 
          </span>
          <span class="tweet-desc mdl-card__title-text-twitt ">
           <p> {{$tweet->text}}  &nbsp;<a href='{{$tweet->link}}'>{{$tweet->link}}</a></p>
          </span>
       
    </div>
  <div class="tweet-button-l" style="">
     <label class="mdl-button mdl-button--icon mdl-js-button mdl-button--icon" for=""  title="Publicated At">
                <i class="material-icons">access_time</i>
                <span class="sr-only">Publicated At</span>
            </label>
            {{$tweet->created_at}}
  </div>
  
        <div class="tweet-button" style="">
           
            {{-- <label class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-button--icon" for=""  title="Stadistcs">
                <i class="material-icons">poll</i>
                <span class="sr-only">Stadistics</span>
            </label> --}}
            
            <a href="https://twitter.com/{{$tweet->social->social_name}}/status/{{$tweet->twitt_id}}" target="_blank"  class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-button--icon" for=""  title="View Tweet">
                <i class="material-icons">public</i>
                <span class="sr-only">View Tweet</span>
            </a>
        
    

            {!! Form::open(array('class' => 'inline-block', 'id' => 'delete_'.$tweet->twitt_id, 'method' => 'DELETE', 'route' =>array('twitter.tweets.delete', $tweet->twitt_id ))) !!}
                {{ method_field('DELETE') }}
                <a href="#" class="dialog-button dialiog-trigger-delete dialiog-trigger{{$tweet->twitt_id}} mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-button--icon" title="Delete Tweet" data-tweetid="{{$tweet->twitt_id}}">
                    <i class="material-icons">delete</i>
                <span class="sr-only">Delete Tweet</span>
                </a>
            {!! Form::close() !!}
    

         
        </div>     
    
</div>

