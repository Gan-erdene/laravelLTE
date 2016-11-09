@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{trans('strings.user')}}
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-user"></i> {{trans('strings.user')}}</a></li>
      <li class="active">{{trans('strings.list')}}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      @include('status')
    <div class="row">
      <!-- left column -->

      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">{{trans('strings.user_list')}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">ID</th>
                  <th>{{trans('strings.last_name')}}</th>
                  <th>{{trans('strings.first_name')}}</th>
                  <th>{{trans('strings.email_address')}}</th>
                  <th>{{trans('strings.created_at')}}</th>
                  <th>{{trans('strings.status')}}</th>
                </tr>
                @foreach($list as $item)
                <tr>
                  <td>{{$item->id}}</td>
                  <td>{{$item->last_name}}</td>
                  <td>{{$item->first_name}}</td>
                  <td>{{$item->email_address}}</td>
                  <td>{{date('Y.m.d H:i', strtotime($item->created_at))}}</td>
                  @if( $item->is_active == 0 )
                    <td>
                      <button data-id="{{$item->id}}" data-toggle="modal"
                        data-target="#confirmmodal" type="button"
                        class="btn btn-warning btn-xs confirmUser"> {{trans('strings.confirm')}} </button>
                    </td>
                  @elseif( $item->is_active == 1 )
                    <td><span class="badge bg-green"> {{trans('strings.active')}} </span></td>
                  @elseif( $item->is_active == 2 )
                    <td><span class="badge bg-red"> {{trans('strings.inactive')}} </span></td>
                  @endif
                </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
          </div>
      </div>

    </div>
    @include('backend.user.confirmModal')
  </section>

</div>

@endsection
@section("javascript")
<script src="/admin/plugins/iCheck/icheck.min.js"></script>
<script>
//Flat red color scheme for iCheck
 $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
   checkboxClass: 'icheckbox_flat-green',
   radioClass: 'iradio_flat-green'
 });

 $(document).on("click", ".confirmUser", function () {
      var userid = $(this).data('id');
      $(".modal-body #userid").val( userid );
 });

</script>
<script>
$(function(){
  $("#_user").addClass("open active");
  $("#_user_list").addClass("active");
  $('#example1').DataTable();

  $('#section_id').on('change', function(){
      $.post("/home/category/action", {'_token':"{{ csrf_token() }}", action:'cat', section_id:this.value}, function(data){
        var chekcboxlist = "";
          $.each(data, function(index, item){
              chekcboxlist +='<label> '+
                    ' <input type="checkbox" id="checkbox" name="checkbox" value="'+item.id+'">'+item.name+'</label>';
          });
          $("#catlist").html(chekcboxlist);
      }, 'json');
  });
});
</script>
@endsection
