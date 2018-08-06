@extends('layouts.dashboard')

@section('template_title')
  Log Information
@endsection

@section('template_fastload_css')
     .mdl-badge[data-badge]:after {
        background-color: inherit;
    }
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
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active">
        <a itemprop="item" href="/logs" class="">
            <span itemprop="name">
                Logs 
            </span>
        </a>
        <meta itemprop="position" content="2" />
    </li>

@endsection

@section('content')

  <div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell--12-col-desktop margin-top-0">

        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
            <h2 class="mdl-card__title-text logo-style">
              Logs
            </h2>

        </div>

     

      <div class="mdl-card__supporting-text mdl-color-text--grey-600 padding-0 context">
      
       @if ($logs === null)
          <div>
            Log file >50M, please download it.
          </div>
        @else
          <div class="table-responsive material-table">
           <table id="table-log" class="mdl-data-table mdl-js-data-table data-table" cellspacing="0" width="100%">
             
          <thead>
            <tr>
              <th class="mdl-data-table__cell">Level</th>
              <th class="mdl-data-table__cell ">Context</th>
              <th class="mdl-data-table__cell">Date</th>
              <th class="mdl-data-table__row  no-sort ">Content</th>
            </tr>
          </thead>
          <tbody>
            @foreach($logs as $key => $log)
          @php


          switch ($log['level']) {
            case 'emergency':
                $LogLevel = [
                  'name'  => '<ud>'.$log['level'].'</u>',
                  'class' => 'mdl-color--red-400'
                ];
              break;
            case 'alert':
                $LogLevel = [
                  'name'  => $log['level'],
                  'class' => 'mdl-color--red-400'
                ];
              break;  
            case 'critical':
                $LogLevel = [
                  'name'  => '<ud>'.$log['level'].'</u>',
                  'class' => 'mdl-color--orange'
                ];
              break; 
               case 'error':
                $LogLevel = [
                  'name'  => $log['level'],
                  'class' => 'mdl-color--orange'
                ];
              break; 
               case 'warning':
                $LogLevel = [
                  'name'  => $log['level'],
                  'class' => 'mdl-color--yellow'
                ];
              break; 
               case 'notice':
                $LogLevel = [
                  'name'  => $log['level'],
                  'class' => 'mdl-color--green'
                ];
              break;    
                case 'info':
                $LogLevel = [
                  'name'  => $log['level'],
                  'class' => 'mdl-color--light-blue-300'
                ];
              break;   
              case 'debug':
                $LogLevel = [
                  'name'  => $log['level'],
                  'class' => 'mdl-color--blue-grey'
                ];
              break;       
            
            default:
              $LogLevel = [
             'name'  => '<ud>'.$log['level'].'</u>',
              'class' => 'mdl-color--red-400'
            ];
              break;
          }

/*
                 
                              

                              $themeUsers = 0;
                              $themeCountClass = 'primary';
                              foreach($users as $user) {
                                  if($user->profile && $user->profile->theme_id === $theme->id) {
                                      $themeUsers += 1;
                                  }
                              }
                              $themeCountClass = 'mdl-color--grey-400';
                              if($themeUsers === 1) {
                                  $themeCountClass = 'mdl-color--blue-400';
                              } elseif($themeUsers >= 2) {
                                  $themeCountClass = 'mdl-color--orange-400';
                              } elseif($themeUsers === 5) {
                                  $themeCountClass = 'mdl-color--green-400';
                              } elseif($themeUsers === 10) {
                                  $themeCountClass = 'mdl-color--red-400';
                              } */
                          @endphp 

            <tr>
              <td class="mdl-data-table__cell--non-numeric ">
                <span class="badge mdl-color-text--white  {{ $LogLevel['class']}}" >
                {!! $LogLevel['name'] !!}
                </span> 
              </td>
              <td class="mdl-data-table__cell--non-numeric ">{{$log['context']}}</td>
              <td class="mdl-data-table__cell--non-numeric ">{{{$log['date']}}}</td>
              <td>
              {{ $log['text']}}
               </td>
            </tr>
            @endforeach
          </tbody>
        </table>
         </div>
        @endif
        <div>
          @if($current_file)
            <a href="?dl={{ base64_encode($current_file) }}"><span class="glyphicon glyphicon-download-alt"></span> Download file</a>
            -
            <a id="delete-log" data-toggle="modal" data-target="#confirmDelete" data-href="?del={{ base64_encode($current_file) }}" data-title="Delete Log File" data-message="Are you sure you want to delete log file?"><span class="glyphicon glyphicon-trash"></span> Delete file</a>
            @if(count($files) > 1)
              -

              <a id="delete-all-log" data-toggle="modal" data-target="#confirmDelete" data-href="?delall=true" data-title="Delete All Log Files" data-message="Are you sure you want to delete all log files?"><span class="glyphicon glyphicon-trash"></span> Delete all files</a>

            @endif
          @endif
          </div>
      </div>



   
     <div class="mdl-card__menu" style="top: -4px;">

            @include('partials.mdl-select')

          

    </div>
  </div>

   @include('dialogs.dialog-delete')

@endsection

@section('footer_scripts')

 @include('scripts.mdl-datatables')

  

@endsection