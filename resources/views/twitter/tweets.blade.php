@extends('layouts.dashboard')

@section('template_title')
  {{-- Showing {{'@'.$social->social_name}}  --}}
@endsection

@section('template_linked_css')
@endsection

@section('header')
    {{-- {{ trans('twitter.title-'.$type) }} {{ trans('twitter.accounts') }}  --}}
@endsection

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
     {{-- <li  itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
     <a itemprop="item" href="/twitter/{{ $social->id }}" >
            <span itemprop="name">
              {{'@'.$social->social_name}}
            </span>
        </a>
         <i class="material-icons">chevron_right</i>
        <meta itemprop="position" content="3" />
    </li>
     <li  itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
     <a class="active" itemprop="item" href="/twitter/{{ $social->id }}/{{$type}}" disabled>
            <span itemprop="name">
               {{ trans('twitter.title-'.$type) }} 
            </span>
        </a>
        <meta itemprop="position" content="4" />
    </li> --}}
@endsection

@section('content')

<div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell--12-col-desktop margin-top-0">
    <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text logo-style">
            @if ($tweets->count() === 1)
                {{ $tweets->count() }} Tweet Sent
            @elseif ($tweets->count() > 1)
                {{ $tweets->count() }} Tweets Sent
            @else
                No Tweets's Sent :(
            @endif
        </h2>

    </div>
    <div class="mdl-card__supporting-text mdl-color-text--grey-600 padding-0 context">
          <div class="" style="margin-top:10px">
           @if ($tweets->count()>0) 
           
                    @foreach ($tweets as $tweet)

                       @include('twitter.cards.tweet')
                          
                    @endforeach
                   
                    @include('dialogs.dialog-delete', ['isAjax'=>true,'dialogTitle' => 'Confirm Tweet Deletion', 'dialogSaveBtnText' => 'Delete'])
 
                           @endif
               <div class="font-small">[*] We're showing only last 250 Tweets for your convenience.</div>  
               <br>          
            </div>
    </div>
    <div class="mdl-card__menu" style="top: -4px;">

        @include('partials.mdl-highlighter')

    </div>

</div>


@endsection

@section('footer_scripts')
 @include('scripts.highlighter-script')

  @if ($tweets->count()>0) 
     <script type="text/javascript">
     
          @foreach ($tweets as $tweet)

            mdl_dialog('.dialiog-trigger{{$tweet->twitt_id}}','','#dialog_delete');
                          
          @endforeach
          

            var tweetId;

            $('.dialiog-trigger-delete').click(function(event) {
                 event.preventDefault();
                tweetId = $(this).attr('data-tweetid');
            });

            $('#confirm').click(function(event) {
                $('form#delete_'+tweetId).submit();
            });

        </script>
  @endif
@endsection