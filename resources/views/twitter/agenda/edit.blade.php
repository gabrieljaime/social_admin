@extends('layouts.dashboard')

@section('template_title')
  Editing Agended Twitt
@endsection

@section('template_linked_css')
  <style type="text/css">
    .btn-save,
    .pw-change-container {
      display: none;
    }
  </style>
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
  <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
       <a itemprop="item" href="/twitter/agenda">
      <span itemprop="name">
        Agended Twitts
      </span>
    </a>
    <i class="material-icons">chevron_right</i>
    <meta itemprop="position" content="2" />
  </li>
  <li class="active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
    <a itemprop="item" href="/twitter/agenda/edit">
      <span itemprop="name">
        Edit Agended Twitt
      </span>
    </a>
    <meta itemprop="position" content="3" />
  </li>
@endsection

@section('content')

 <div class="mdl-grid full-grid margin-top-0 padding-0">
    <div class="mdl-cell mdl-cell mdl-cell--12-col mdl-cell--12-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop mdl-card mdl-shadow--3dp margin-top-0 padding-top-0">
        <div class="mdl-card card-edit-agenda" style="width:100%;" itemscope itemtype="http://schema.org/Person">
        
         <div class="mdl-card__title mdl-card--expand mdl-color--green mdl-color-text--white">
          <h2 class="mdl-card__title-text logo-style">Editing Agended Twitt</strong></h2>
       
        </div>
            

          {!! Form::model($agenda, array('action' => array('TwitterAgendaController@update', $agenda->id), 'method' => 'PUT', 'file'=>true,'enctype'=> 'multipart/form-data')) !!}

            {!! csrf_field() !!}
            
           @include('twitter.agenda.fields',['edit'=>true])
      
       

          {!! Form::close() !!}


      </div>
    </div>
  </div>

@endsection

@section('footer_scripts')

  @include('scripts.mdl-required-input-fix')
  @include('scripts.gmaps-address-lookup-api3')

  <script type="text/javascript">
    mdl_dialog('.dialog-button-save');
    mdl_dialog('.dialog-button-tweet');
    mdl_dialog('.dialog-button-icon-save');
  </script>

@endsection