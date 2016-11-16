@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<link href="/frontend/assets/css/photos1.css" rel="stylesheet">
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<script>
$(document).ready(function () {
  $("#menu_list_work").addClass('active');

  $(".announce").click(function(){ // Click to only happen on announce links
     $("#workid").val($(this).data('id'));
   });
});
</script>
@endsection
@section('content')
<div class="container page-content">
  <div class="row">
    @include('frontend.workMenu')
      <div class="col-md-7 animated fadeInRight">
        @include('status')
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">{{ sprintf(trans('strings.your_added_work'),$list->total()) }} </h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="row">
                <div class="table-responsive">
            <table class="table user-list">
              <thead>
                @if(sizeof($list) > 0)
                <tr>
                  <th><span>{{trans('strings.project_name')}}</span></th>
                  <th><span>{{trans('strings.created_at')}}</span></th>
                  <th class="text-center"><span>{{trans('strings.status')}}</span></th>
                  <th class="text-center"><span>Санал</span></th>
                  <th><span>{{trans('strings.price')}}</span></th>
                  <th>&nbsp;</th>
                </tr>
                @else
                <tr>
                  <td colspan="5">  <i>{{trans('strings.empty_work')}}</i> </td>
                </tr>
                @endif
              </thead>
              <tbody>
                @foreach($list as $item)
                <tr>
                  <td>{{str_limit($item->project_name, 30)}} </td>
                  <td> {{date('Y.m.d', strtotime($item->created_at))}}</td>
                  <td class="text-center">
                    @if($item->is_active === 0)
                    <span class="label label-danger">{{trans('strings.inactive')}}</span>
                    @else
                    <span class="label label-success">{{trans('strings.active')}}</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <span class="badge">{{$item->proposalCount()}}</span>
                  </td>
                  <td class="text-right">
                    <a href="#">{{$item->price}}</a>
                  </td>
                  <td style="width: 20%;">
                    <a href="#" class="table-link success">
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                      </span>
                    </a>
                    <a href="{{route('editWork', $item->id)}}" class="table-link">
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                      </span>
                    </a>
                    <a data-id="{{$item->id}}" href="#" data-toggle="modal" data-target="#myModal" class="table-link danger announce" >
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                      </span>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
              </div>
              @if(sizeof($list) > 0)
              <div class="row">
                <div class="col-sm-12">
                  {!! $list->links() !!}
                </div>
              </div>
              @endif
          </div>

      </div>
  </div>
  <div class="example-modal">
      <div class="modal modal-danger"  id="myModal">
        <div class="modal-dialog">
          <form method="post" class="modal-content" action="{{route('workAction')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="workid" id="workid">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Устгах цонх</h4>
            </div>
            <div class="modal-body">
              <p>Та устгахдаа итгэлтэй байна уу ?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"> Болих </button>
              <button type="submit" class="btn btn-outline"> Устгах </button>
            </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>

</div>
@endsection
