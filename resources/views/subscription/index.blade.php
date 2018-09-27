@extends('layouts.dashboard') 
@section('template_title') {{trans_choice('plans.plans',2)}}
@endsection
 
@section('template_fastload_css')

@endsection
 
@section('header') {{trans_choice('plans.plans',2)}}
@endsection
 
@section('breadcrumbs')

<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
    <a itemprop="item" href="{{url('/')}}">
            <span itemprop="name">
                {{ trans('titles.app') }}
            </span>
        </a>
    <i class="material-icons">chevron_right</i>
    <meta itemprop="position" content="1" />
</li>
<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">
    <a itemprop="item" href="" class="">
            <span itemprop="name">
               {{trans_choice('plans.plans',2)}}
            </span>
        </a>
    <meta itemprop="position" content="2" />
</li>
@endsection
 
@section('content') 

<div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell--12-col-desktop margin-top-0">
  <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
   {{trans_choice('plans.plans',2)}}
    <div class="right" style="position: absolute; right: 10px;">
    @if  ($user->subscribed('main') && ($user->subscrip->first()->ends_at))
    <span class="mdl-chip mdl-color--orange ">							
      <span class="mdl-chip__text mdl-color-text--white" style="font-size:13px">
        <strong> {{__('plans.expired')}}{{ $user->subscrip->first()->ends_at->diffForHumans()}} </strong>
      </span>
    </span>
    
    @endif
    </div>
  </div>
  <div class="mdl-card__supporting-text mdl-color-text--grey-600 mdl-grid">


@foreach ( $plansFree as $plan )
  @include('subscription.plan',['name' => $plan->name , 'profiles'=> $plan->profile, 'social'=> $plan->social, 'agended'=>$plan->agended, 
  'feeds'=> $plan->feed, 'tweets'=>$plan->automatic, 'whitelist'=> $plan->whitelist, 'unfollow'=> $plan->unfollowall,'community'=> $plan->ranking, 
  'price_m'=>$plan->price_m,'price_y'=>$plan->price_y])
@endforeach
@foreach ( $plansNoFree as $plan )
  @include('subscription.plan',['name' => $plan->name , 'profiles'=> $plan->profile, 'social'=> $plan->social, 'agended'=>$plan->agended, 
  'feeds'=> $plan->feed, 'tweets'=>$plan->automatic, 'whitelist'=> $plan->whitelist, 'unfollow'=> $plan->unfollowall,'community'=> $plan->ranking, 
  'price_m'=>$plan->price_m,'price_y'=>$plan->price_y])
@endforeach


  @include('subscription.modal')
  </div>
</div>



@endsection

@section('footer_scripts') 



<script>

var plan_selected;

  @foreach ( $plansNoFree as $plan )
    mdl_dialog_plan('{{$plan->name}}');
  @endforeach

 @if (isset($user_plan->name) && ($user_plan->name!='Free'))
    mdl_dialog('.dialog-button-unsubscribe','.dialog-unsubscribe-close','#dialog_unsubscribe');
  @endif
function mdl_dialog_plan(plan) {
  'use strict';
  var close = '#cancel';
  var dialog ='#confirmSub';
  var trigger = '.dialog-button'+plan ;
 

  if (!document.querySelector(dialog).showModal) {
      dialogPolyfill.registerDialog(document.querySelector(dialog));
  }
  document.querySelector(trigger).addEventListener('click', function(event) {
    event.preventDefault();
    planselected(plan);
    document.querySelector(dialog).showModal();
    document.querySelector(dialog).open=true;
  });
  document.querySelector(close).addEventListener('click', function(event) {
    event.preventDefault();
    document.querySelector(dialog).open=true;
    document.querySelector(dialog).close();
    document.querySelector(dialog).open=false;
  });
};

  @foreach ( $plansNoFree as $plan )
    $('#plan{{$plan->name}}').click(function(event) { planselected('{{$plan->name}}'); });
    $('#plan{{$plan->name}}_y').click(function(event) { planselected('{{$plan->name}}_y'); });
  @endforeach


  $('#accept').change(function() { 
    accept_change(this.checked);
  });

function accept_change(check){
   if(check) {
      if(your_plan==plan_selected)
      {
          $('#confirm').prop('disabled', true);
          $('#confirm').addClass('mdl-color--accent');
          $('#confirm').removeClass('mdl-color--grey'); 
          $('#toolacept').html('You alredy have this Plan');
          $('#toolacept').addClass('mdl-tooltip');
          $('#toolacept').removeClass('hidden');

      }
      else{
          $('#confirm').prop('disabled', false);
          $('#confirm').addClass('mdl-color--green');
          $('#confirm').removeClass('mdl-color--grey'); 
          $('#confirm').removeClass('mdl-color--accent');
          $('#toolacept').removeClass('mdl-tooltip');
          $('#toolacept').addClass('hidden');
      }      
    }
      else {
      $('#confirm').prop('disabled', true);
      $('#confirm').addClass('mdl-color--grey');
      $('#confirm').removeClass('mdl-color--green'); 
      $('#confirm').removeClass('mdl-color--accent');
      $('#toolacept').addClass('mdl-tooltip');
     $('#toolacept').removeClass('hidden');
     $('#toolacept').html('You have to Accept <br>the Terms & Conditions');
      
      }
}
  function planselected(plan) {
    
    plan_selected=plan;
    your_plan=null;

  @if ($user->subscribed('main'))
    if ('{{isset($user_plan->name)}}')
    {
      if ( '{{$user_plan->stripe_id_m}}' == '{{$user->subscription('main')->stripe_plan}}')
      {
        your_plan = '{{$user_plan->name}}';
        $('#plan{{$user_plan->name}} .material-icons').removeClass('hidden');
        $('#plan{{$user_plan->name}} .mdl-card__title').addClass('mdl-color--accent');
      }
      else if ( '{{$user_plan->stripe_id_y}}' == '{{$user->subscription('main')->stripe_plan}}')
      {
        your_plan = '{{$user_plan->name}}_y';
        $('#plan{{$user_plan->name}}_y .material-icons').removeClass('hidden');
        $('#plan{{$user_plan->name}}_y .mdl-card__title').addClass('mdl-color--accent');
        
      }
     
    }
    @endif
   
    @foreach ( $plansNoFree as $plan ) 
    
      if ('{{$plan->name}}_y'==plan) {

          if ('{{$plan->name}}_y'==your_plan)
          {
            
            
            $('#selected-plan h6 strong').text('{{$plan->name}} Yearly');
            $('#selected-plan p').text('$ {{$plan->price_y}} (us dollars) for {{$plan->profile}} Profile / {{$plan->social}} Social / {{$plan->feed}} Feeds / {{$plan->automatic}} Automatics messages/day per Year '); 
           

            $('#plan{{$plan->name}}').removeClass('plan-selected');
            $('#plan{{$plan->name}} .mdl-card__title').addClass('mdl-color--grey');
            $('#plan{{$plan->name}} .mdl-card__title').removeClass('mdl-color--primary');
          }
          else
          {
            $('#plan{{$plan->name}}_y').addClass('plan-selected'); 
            $('#plan{{$plan->name}}_y .mdl-card__title').addClass('mdl-color--primary');
            $('#selected-plan h6 strong').text('{{$plan->name}} Yearly');
            $('#selected-plan p').text('$ {{$plan->price_y}} (us dollars) for {{$plan->profile}} Profile / {{$plan->social}} Social / {{$plan->feed}} Feeds / {{$plan->automatic}} Automatics messages/day per Year '); 
            $('.mdl-spinner-text span').text('Subscribe to the plan');
            $('.mdl-spinner-text strong').text('{{$plan->name}} Yearly');

            $('#plan{{$plan->name}}').removeClass('plan-selected');
            $('#plan{{$plan->name}} .mdl-card__title').addClass('mdl-color--grey');
            $('#plan{{$plan->name}} .mdl-card__title').removeClass('mdl-color--primary');
          }
     }
     else if ('{{$plan->name}}'==plan) {

           if ('{{$plan->name}}'==your_plan)
          {

            $('#selected-plan h6 strong').text('{{$plan->name}} Yearly');
            $('#selected-plan p').text('$ {{$plan->price_y}} (us dollars) for {{$plan->profile}} Profile / {{$plan->social}} Social / {{$plan->feed}} Feeds / {{$plan->automatic}} Automatics messages/day per Year '); 
            $('.mdl-spinner-text span').text('');
            $('.mdl-spinner-text strong').text('You have this Plan');

            $('#plan{{$plan->name}}').removeClass('plan-selected');
            $('#plan{{$plan->name}} .mdl-card__title').addClass('mdl-color--grey');
            $('#plan{{$plan->name}} .mdl-card__title').removeClass('mdl-color--primary');
          }
          else
          {
            $('#plan{{$plan->name}}').addClass('plan-selected'); 
            $('#plan{{$plan->name}} .mdl-card__title').addClass('mdl-color--primary');
            $('#selected-plan h6 strong').text('{{$plan->name}} Monthly');
            $('#selected-plan p').text('$ {{$plan->price_m}} (us dollars) for {{$plan->profile}} Profile / {{$plan->social}} Social / {{$plan->feed}} Feeds / {{$plan->automatic}} Automatics messages/day per Month'); 
            $('.mdl-spinner-text span').text('Subscribe to the plan');
            $('.mdl-spinner-text strong').text('{{$plan->name}} Monthly');
            $('#plan{{$plan->name}}_y').removeClass('plan-selected');
            $('#plan{{$plan->name}}_y .mdl-card__title').addClass('mdl-color--grey');
            $('#plan{{$plan->name}}_y .mdl-card__title').removeClass('mdl-color--primary');
          }
     }
     else
     {

      $('#plan{{$plan->name}}').removeClass('plan-selected');
      $('#plan{{$plan->name}} .mdl-card__title').addClass('mdl-color--grey');
      $('#plan{{$plan->name}} .mdl-card__title').removeClass('mdl-color--primary');
      $('#plan{{$plan->name}}_y').removeClass('plan-selected');
      $('#plan{{$plan->name}}_y .mdl-card__title').addClass('mdl-color--grey');
      $('#plan{{$plan->name}}_y .mdl-card__title').removeClass('mdl-color--primary');
     }

    @endforeach

  accept_change($('#accept').prop('checked'));
}

@include('subscription.stripe')
  
</script>
@endsection