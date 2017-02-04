@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/user_detail.css" rel="stylesheet">
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<script>
  $(document).ready(function(){
    $('#_eventd').addClass('active');
  });
</script>
@endsection
@section('content')
<div class="container page-content ">
      <div class="row">
        <!-- left links -->
        @include('frontend.newsfeed.leftmenu')
        @if(isset($event) and $event)
        <div class="col-md-9">
          <div class="box box-widget">
              <div class="box-header with-border">
                <div class="user-block">
                  <h4><a>{{$event->title}}</a><br/> <small style="font-size:13px">Эхлэх өдөр: {{date('Y оны m сарын d', strtotime($event->eventdate))}}</small></h4>
                </div>
              </div>

              <div class="box-body" style="display: block;">
                <img class="img-responsive show-in-modal" src="{{$event->eventimage}}" alt="Photo"><br/>
                <p>{!!$event->content!!}</p>
              </div>
            </div>
        </div>
        @endif
      </div>
    </div>
@endsection
