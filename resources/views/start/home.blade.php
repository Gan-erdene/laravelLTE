@extends('layouts.start')
@section('javascripts')
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
@endsection
@section('content')
<div class="container page-content page-friends">
        <div class="row">
          <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="file-manager">
                      <div class="row">
                        @foreach($sections as $section)
                        <div class="col-md-4">
                          <div class="file-manager">
                              <div class="hr-line-dashed"></div>
                              <button class="btn btn-azure btn-block">{{$section->secTrans('mn')->name}}</button>
                              <div class="hr-line-dashed"></div>
                              <h5>Type</h5>
                              <ul class="folder-list" style="padding: 0">
                                  <li><a href=""><i class="fa fa-camera"></i> Videos</a></li>
                                  <li><a href=""><i class="fa fa-image"></i> Pictures</a></li>
                                  <li><a href=""><i class="fa fa-music"></i> Sounds</a></li>
                              </ul>
                              <div class="clearfix"></div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
              </div>
        </div>
        </div>
      </div>
@endsection
