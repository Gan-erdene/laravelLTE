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
                        @foreach($sections as $section)
                        @if(($loop->index )%3 === 0)<div class="row">@endif
                          <div class="col-md-4">
                            <div class="file-manager">
                                <div class="hr-line-dashed"></div>
                                <h5 class="attachment-heading"><i class="fa fa-navicon"></i> {{$section->secTrans('mn')->name}}</h5>
                                <div class="hr-line-dashed"></div>
                                <ul class="folder-list" style="padding: 0">
                                    @foreach($section->categories() as $category)
                                    <li><a href="{{route('startCatView')}}?id={{$category->id}}"><i class="fa fa-angle-right"></i> {{$category->catTrans('mn')->name}}</a></li>
                                    @endforeach
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                          </div>
                          @if(($loop->index + 1)%3 === 0)</div>@endif
                        @endforeach
                    </div>
                  </div>
              </div>
        </div>
        </div>
      </div>
@endsection
