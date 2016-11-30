@extends('layouts.start')
@section('javascripts')
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<style>
  .catselected {
    background-color:#3ecdf1;
    padding-left: 10px;
  }
  li.catselected a {
    color:#fff;
  }
  li.catselected a i {
    color:#fff;
  }
</style>
@endsection
@section('content')
<div class="container page-content ">
      <div class="row">
        <div class="col-md-3">
          <div class="ibox float-e-margins">
              <div class="ibox-content">
                  <div class="file-manager">
                      <div class="hr-line-dashed"></div>
                      <h5><i class="fa fa-navicon"></i> {{$section->secTrans('mn')->name}}</h5>
                      <div class="hr-line-dashed"></div>
                      <ul class="folder-list" style="padding: 0">
                        @foreach($categories as $cat)
                          @if($cat->id === $category->id)<li class="catselected"  >@else <li> @endif <a href=""> <i class="fa fa-angle-right"></i> {{$cat->catTrans('mn')->name}}</a></li>
                          @endforeach
                      </ul>
                      <div class="clearfix"></div>
                  </div>
              </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="row">
              <div class="col-md-11">
                @foreach($works as $work)
                @if($work->work->userAvatar)
                <div class="box box-widget">
                  <div class="box-header with-border">
                    <div class="user-block">
                      <img class="img-circle" src="{{$work->work->userAvatar->getAvatar()}}" alt="User Image">
                      <span class="username"><a href="#">{{$work->work->userAvatar->first_name}} {{$work->work->userAvatar->last_name}}</a></span>
                      <span class="description">Нийтэлсэн - {{$work->work->created_at}}</span>
                    </div>
                  </div>
                  <div class="box-body">

                    <div class="attachment-block clearfix">
                      @if(isset($work->work->images()[0]))
                      <img class="attachment-img show-in-modal" src="/uploads/work/{{$work->work->images()[0]->timestamp}}.{{$work->work->images()[0]->extention}}" alt="Attachment Image">
                      @else
                      <img class="attachment-img show-in-modal" src="/frontend/img/Photos/3.jpg" alt="Attachment Image">
                      @endif
                      <div class="attachment-pushed">
                      <h5 class="attachment-heading"><a href="#">{{$work->work->project_name}}</a></h5>
                      <div class="attachment-text">
                      {!!str_limit($work->work->reference, 50)!!}
                      </div>
                      </div>
                    </div>
                    <b>Үнэ: </b> {{$work->work->price}}
                    <br/>
                    <b>Хугацаа: </b> {{$work->work->startdate}} - {{$work->work->enddate}}
                  </div>
                </div>
                @endif
                @endforeach
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection
