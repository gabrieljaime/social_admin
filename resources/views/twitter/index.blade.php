@extends('layouts.dashboard')

@section('template_title')
  Showing   {{ Auth::user()->name }} 
@endsection

@section('template_linked_css')
@endsection

@section('header')
   {{ Auth::user()->name }}  {{ trans('twitter.accounts') }} 
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
    <li  class="active"itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a class="active" itemprop="item" href="/twitter"  disabled >
            <span itemprop="name">
                Twitter's
            </span>
        </a>
        <meta itemprop="position" content="2" />
    </li>
   
@endsection

@section('content')

@include('twitter.cards.twitter-accounts')


@endsection
