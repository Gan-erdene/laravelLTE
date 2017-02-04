@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>&nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-question-circle"></i> Арга хэмжээ</a></li>
      <li class="active">Жагсаалт</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      @include('status')
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
              <h3 class="box-title">Нийт арга хэмжээ</h3>

              <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                  <li><a href="{{route('eventAdd')}}" class="btn bg-olive margin" type="button"> Нэмэх </a></li>
                </ul>
              </div>
            </div>
          <!-- /.box-header -->
          <div class="box-body">
            @if(sizeof($list)>0)
            <table class="table table-bordered">
              <tr>
                <th>#</th>
                <th>Гарчиг</th>
                <th>Болох өдөр</th>
                <th width="20%"></th>
              </tr>
              @foreach($list as $item)
              <tr id="row_{{$item->id}}" @if(strtotime($item->eventdate) > mktime(0, 0, 0)) class="success" @endif>
                <td>{{$loop->index+1}}</td>
                <td>{{str_limit($item->title, 40)}}</td>
                <td>{{$item->eventdate}}</td>
                <td><button data-id="{{$item->id}}" class="btn btn-danger removeEvent"> <i class="fa fa-trash"></i> Устгах </button></td>
              </tr>
              @endforeach
            </table>
            @else
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <span><i class="icon fa fa-warning"></i> Ямар нэгэн арга хэмжээ бүртгэгдээгүй байна.</span>
              </div>
            @endif
          </div>
        </div>
      </div>
      <!--/.col (left) -->

    </div>
  </section>

</div>

@endsection
@section("javascript")
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
  $(function(){
      $("#_eventx").addClass("active");
      $(".removeEvent").on('click',function(){
        $.post("{{route('eventAction')}}", {action:"delete", '_token':"{{ csrf_token() }}", value:$(this).data('id')},function(data){
          $(data.id).remove();
        }, 'json');

      });
  });
</script>
@endsection
