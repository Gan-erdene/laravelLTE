@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<link href="/frontend/assets/css/photos1.css" rel="stylesheet">
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<script>

</script>
@endsection
@section('content')
<div class="container page-content">
  <div class="row">
    @include('frontend.workMenu')
      <div class="col-md-7 animated fadeInRight">
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">{{trans('strings.list_work')}}</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="row">
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <ul class="pagination">
                      <li>
                          <a href="#" aria-label="Previous">
                              <span aria-hidden="true">«</span>
                          </a>
                      </li>
                      <li class="active"><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li>
                          <a href="#" aria-label="Next">
                              <span aria-hidden="true">»</span>
                          </a>
                      </li>
                  </ul>
                </div>
              </div>
          </div>

      </div>
  </div>

</div>
@endsection
