@extends('layouts.start')
@section('css')
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<style>
  ul li:nth-child(n+4) {
      display:none;
  }
  .no-bullets {
      list-style-type: none;
  }
  span.readmore {
      cursor: pointer;
  }
</style>
@endsection
@section('javascripts')
<script>
$(function () {
  $('span.readmore').click(function () {
    var dataid =$(this).data('id');
      $('.datalist_'+dataid+' li:hidden').slice(0, 3).show();
      if ($('.datalist_'+dataid+' li').length == $('.datalist_'+dataid+' li:visible').length) {
          $('span.mana_'+dataid).hide();
      }
  });
});
</script>
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
                                <h5 class="attachment-heading"><i class="fa fa-navicon" style="color:#39BBDB"></i> {{$section->secTrans('mn')->name}}</h5>
                                <div class="hr-line-dashed"></div>
                                <ul class="folder-list datalist_{{$section->id}} no-bullets" style="padding: 0">
                                    @foreach($section->categories() as $category)
                                    <li><a href="{{route('startCatView')}}?id={{$category->id}}"><i class="fa fa-angle-right"></i> {{$category->catTrans('mn')->name}}</a></li>
                                    @endforeach
                                </ul><span data-id="{{$section->id}}" class="btn btn-info btn-xs readmore mana_{{$section->id}}">Дэлгэрэнгүй</span>
                                <br/><br/><br/>
                                <div class="clearfix"></div>
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
