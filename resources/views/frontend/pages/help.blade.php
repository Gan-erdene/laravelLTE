@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<style>
.expand_container {
  width:100%;
}
.expand_container div {
  width:100%;
}
.expand_container .expand_header {
  background-color: #f8f7f5;
  border-bottom:1px solid #ebeae6;
  padding: 10px;
  color: #89817f;
  cursor: pointer;
}
.expand_container .content {
  display: none;
  padding : 5px;
}
</style>
<script>
$(document).ready(function(){
  $('#page_{{$_page}}').addClass('active');
});
var oldContent = null;
$(document).on ('click', '.expand_header', function () {

    $header = $(this);
    //getting the next element
      $content = $header.next();
    
    $content.slideToggle(400, function () {
      oldContent = $content;
    });
  } );
</script>
@endsection
@section('content')
<div class="container page-content">
  <div class="row">
    <div class="col-md-3">
      @include('frontend.pages.menu')
    </div>
    <div class="col-md-9">
      <div class="widget">
            <div class="widget-body">
                <div class="expand_container">
                  @foreach($helps as $help)
                    <div class="expand_header"><span> <i class="fa fa-chevron-down"></i> {{$help->questions}}</span>

                    </div>
                    <div class="content">
                        {!!$help->answers!!}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
