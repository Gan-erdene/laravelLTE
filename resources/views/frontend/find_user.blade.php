@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/friends.css" rel="stylesheet">
@endsection
@section('content')
<div class="row page-content">
  <div class="col-md-8 col-md-offset-2">
    <div class="row">
      @foreach($users as $item)
      <div class="col-md-3">
          <div class="contact-box center-version">
            <a href="#">
              <img alt="image" class="img-circle" src="/frontend/img/Friends/guy-1.jpg">
              <h4 class="m-b-xs">{{$item->last_name}}<br>{{$item->first_name}}</h4>

              <div class="font-bold">Graphics designer</div>
            </a>
            <div class="contact-box-footer">
              <div class="m-t-xs btn-group">
                <button class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> {{trans('strings.add_friend')}}</button>
              </div>
            </div>
          </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection
