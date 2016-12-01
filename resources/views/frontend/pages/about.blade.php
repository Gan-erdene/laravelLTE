@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<script>
$(document).ready(function(){
  $('#page_{{$_page}}').addClass('active');
});
</script>
@endsection
@section('content')
<div class="container page-content">
  <div class="row">
    <div class="col-md-3">
      <div class="profile-nav">
        @include('frontend.pages.menu')
      </div>
    </div>
    <div class="col-md-6">
    </div>
  </div>
</div>
@endsection
