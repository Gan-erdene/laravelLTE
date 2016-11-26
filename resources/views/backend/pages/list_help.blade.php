@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-user"></i> Ажлын захиалга</a></li>
      <li class="active">Захиалгын жагсаалт</li>
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
              <h3 class="box-title">Тусламжууд</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered work-list">
                <tbody><tr>
                  <th nowrap >Д/д</th>
                  <th nowrap >Эрэмбэ</th>
                  <th>Асуулт</th>
                  <th>Бүртгэсэн огноо</th>
                </tr>
                @foreach($helps as $item)
                <tr class='clickable-row' data-href="{{route('editHelp', $item->id)}}">
                  <td>{{$loop->index+1}}</td>
                  <td>{{$item->order_id}}</td>
                  <td>{{$item->questions}}</td>
                  <td>{{date('Y.m.d H:i', strtotime($item->created_at))}}</td>
                </tr>
                @endforeach
              </tbody></table>

            </div>

          </div>
      </div>

    </div>
    @if(sizeof($helps) > 0)
    <div class="row">
      <div class="col-sm-12">
        {!! $helps->links() !!}
      </div>
    </div>
    @endif
  </section>

</div>

@endsection
@section("javascript")
<style>
  table.work-list tr:hover td {
  background-color: #e9eaed;
  cursor:pointer;
  }
</style>
<script>
$(function(){
  $("#_help").addClass("open active");
  $("#_help_list").addClass("active");

  $(".clickable-row").click(function() {
      window.document.location = $(this).data("href");
  });
});
</script>
@endsection
