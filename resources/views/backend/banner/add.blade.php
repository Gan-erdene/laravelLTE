@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>&nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-question-circle"></i> Суталчилгаа</a></li>
      <li class="active">Өөрчлөх</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      @include('status')
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              @foreach($banners as $banner)
              <li  @if($loop->index === 0 )class="active" @endif><a href="#tab_{{$banner->position}}" data-toggle="tab" aria-expanded="true">Сурталчилгаа {{$banner->position}}</a></li>
              @endforeach
            </ul>
            <div class="tab-content">
              @foreach($banners as $banner)
              <div
                @if($loop->index === 0 )
                  class="tab-pane active"
                @else
                class="tab-pane"
                @endif id="tab_{{$banner->position}}">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
                          <form role="form" action="{{route('bannerAction')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="action" value="change">
                            <input type="hidden" name="bannerid" value="{{$banner->id}}">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Дарсан тоо</label>
                                <input class="form-control" readonly="true" value="{{$banner->clickcount}}" >
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Хандах хаяг</label>
                                <input class="form-control" name="url" value="{{$banner->url}}" >
                              </div>
                              <div class="form-group">
                                <label for="exampleInputFile">Сурталчилгаа солих</label>
                                <input name="file" type="file" >
                              </div>
                              <div class="form-group">
                                <select class="form-control" name="canview" >
                                    <<option @if($banner->canview === 0) selected @endif value="0">Сурталчилгааг харуулахгүй</option>
                                    <<option @if($banner->canview === 1) selected @endif value="1">Сурталчилгааг харуулна</option>
                                </select>
                              </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                              <button type="submit" class="btn btn-primary">Хадгалах</button>
                            </div>
                          </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <img src="{{$banner->image_path}}" style="width:100%">
                    </div>
                  </div>

              </div>
              @endforeach
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
      </div>
      <!--/.col (left) -->

    </div>
  </section>

</div>

@endsection
@section("javascript")
<link rel="stylesheet" href="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="/admin/plugins/iCheck/icheck.min.js"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script src="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
$(function(){
  $("#_banner").addClass("active");

});
</script>
@endsection
