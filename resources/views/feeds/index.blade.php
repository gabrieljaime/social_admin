@extends('layouts.dashboard')

@section('template_title')
  Showing Feeds
@endsection

@section('template_linked_css')
@endsection

@section('header')
    Showing All Feeds
@endsection

@php
    $enableDataTablesCount = 50;
@endphp

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
    <li class="active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="/feeds" disabled>
            <span itemprop="name">
                Feeds List
            </span>
        </a>
        <meta itemprop="position" content="2" />
    </li>
@endsection

@section('content')

<div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell--12-col-desktop margin-top-0">
    <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text logo-style">
            @if (count($feeds) === 1)
            {{ count($feeds) }} Feed total
            @elseif (count($feeds) > 1)
                {{ count($feeds) }} Total Feeds
            @else
                No Feeds :(
            @endif
        </h2>

    </div>
    <div class="mdl-card__supporting-text mdl-color-text--grey-600 padding-0 context">
        <div class="table-responsive material-table">
            <table id="feeds_table" class="mdl-data-table mdl-js-data-table data-table" cellspacing="0" width="100%">
              <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Name</th>
                    <th class="mdl-data-table__cell--non-numeric">Interval</th>
                    <th class="mdl-data-table__cell--non-numeric">Posts</th>
                    <th class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">Start Text</th>
                    <th class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">End Text</th>
                    <th class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">Assinged to</th>
                    <th class="mdl-data-table__cell--non-numeric">Status</th>
                    <th class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">Created</th>
                    <th class="mdl-data-table__cell--non-numeric no-sort no-search">Actions</th>
                </tr>
              </thead>
              <tbody>
                    @foreach ($feeds as $feed)
                                    
                                                   
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric"><a href="{{ URL::to('feeds/' . $feed->id) }}">{{$feed->name}}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{$feed->term_to_check}} </td>
                            <td class="mdl-data-table__cell--non-numeric">{{$feed->post_by_check}} </td>
                            <td class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">{{$feed->begin}}</td>
                            <td class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">{{$feed->end}} </td>
                            <td class="mdl-data-table__cell--non-numeric "><a href="{{url('twitter/'.$feed->social_id)}}">{{'@'.App\Models\Social::find($feed->social_id)->social_name}}</a> </td>
                            <td class="mdl-data-table__cell--non-numeric">
                                                     
                                   
                                        @if ($feed->active)
                                         <span class="mdl-chip mdl-color-text--white mdl-color--green md-chip">
                                             <span class="mdl-chip__text">ON</span>
                                              </span>
                                        @else
                                         <span class="mdl-chip mdl-color-text--white mdl-color--reed md-chip">
                                             <span class="mdl-chip__text">OFF</span>
                                              </span>
                                        @endif
                                    
                                    
                            </td>
                            <td class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">{{ $feed->created_at->format('d/m/Y H:i:s')}}</td>

                            <td class="mdl-data-table__cell--non-numeric">


                                {{-- VIEW USER ACCOUNT ICON BUTTON --}}
                                <a href="{{ URL::to('feeds/' . $feed->id) }}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" title="View Feed">
                                    <i class="material-icons mdl-color-text--blue">visibility</i>
                                </a>

                                {{-- EDIT USER ICON BUTTON --}}
                                <a href="{{ URL::to('feeds/' . $feed->id . '/edit') }}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" title="Edit Feed">
                                    <i class="material-icons mdl-color-text--orange">edit</i>
                                </a>

                                {{-- DELETE ICON BUTTON AND FORM CALL --}}
            
                                  {!! Form::open(array('class' => 'inline-block', 'id' => 'delete_'.$feed->id, 'method' => 'DELETE', 'route' => array('feeds.destroy', $feed->id))) !!}
                                    {{ method_field('DELETE') }}
                                    <a href="#" class="dialog-button dialiog-trigger-delete dialiog-trigger{{$feed->id}} mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" data-feedid="{{$feed->id}}">
                                        <i class="material-icons mdl-color-text--red    ">delete</i>
                                        <span class="sr-only">Delete Feed</span>
                                    </a>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
              </tbody>
            </table>
        </div>
    </div>
    <div class="mdl-card__menu" style="top: -4px;">

        @include('partials.mdl-highlighter')

        @include('partials.mdl-search')

        <a href="{{ url('/feeds/create') }}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-color-text--white" title="Add New Feed">
            <i class="material-icons">add</i>
            <span class="sr-only">Add New Feed</span>
        </a>

    </div>
</div>

@include('dialogs.dialog-delete')

@endsection

@section('footer_scripts')
    @include('scripts.highlighter-script')
    @include('scripts.mdl-datatables')
    <script type="text/javascript">
      
            @foreach ($feeds as $feed)
                mdl_dialog('.dialiog-trigger{{$feed->id}}','','#dialog_delete');
            @endforeach

            var feedId;

            $('.dialiog-trigger-delete').click(function(event) {
                event.preventDefault();
                feedId = $(this).attr('data-feedid');
            });

            $('#confirm').click(function(event) {
                $('form#delete_'+feedId).submit();
            });

    </script>
@endsection