@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/people_directory.css" rel="stylesheet">
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<style>
.datepicker{z-index:1151 !important;}
</style>
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
        <div class="col-md-9">
          <div class="row">
            <!-- left posts-->
            @if(sizeof($events) <= 0 )
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <span><i class="icon fa fa-warning"></i> Ямар нэгэн арга хэмжээ бүртгэгдээгүй байна.</span>
              </div>
            @endif
            @foreach($events as $item)
            <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="panel">
                  <div class="panel-body">
                      <div class="media">
                          <a class="pull-left" href="#">
                              <img class="thumb media-object" src="{{$item->eventimage}}" style="max-height:200px;max-width:150px" alt="">
                          </a>
                          <div class="media-body">
                              <h4><span class="text-muted small"> <a href="/frontend/events/{{$item->id}}">{{$item->title}}</a> </span></h4>
                              <address>
                                  <strong>Болох өдөр</strong>&nbsp; &nbsp; @if(strtotime($item->eventdate) > mktime(0, 0, 0))
                                  <span class="label label-success">Удахгүй болох</span>
                                  @else
                                  <span class="label label-danger">Хугаа өнгөрсөн</span>
                                  @endif <br/>
                                  {{$item->eventdate}}
                              </address>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              @endforeach
          </div>
        </div><!-- end  center posts -->

      </div>
    </div>
@endsection
