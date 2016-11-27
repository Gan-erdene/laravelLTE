@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
@endsection
@section('content')
<div class="container page-content">
  <div class="row">
    <div class="col-md-3">
      <div class="profile-nav">
        <div class="widget">
            <div class="widget-body">
              <ul class="nav nav-pills nav-stacked">
                <li ><a style="padding: 5px 10px;" href="{{route('viewHelp')}}"> <i class="fa fa-question-circle purple"></i>  Тусламж </a></li>
                <li class="active"><a style="padding: 5px 10px;" href="#"> <i class="fa fa-info-circle"></i>  Бидний тухай</a></li>
              </ul>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
    </div>
  </div>
</div>
@endsection
