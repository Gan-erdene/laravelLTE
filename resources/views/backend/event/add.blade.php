@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
@endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>&nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-question-circle"></i> Тусламж</a></li>
      <li class="active">асуулт хариулт бүртгэх</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      @include('status')
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <form method="POST" enctype="multipart/form-data" action="{{route('eventAction')}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="action" value="store">
            <div class="form-group">
              <label>Гарчиг</label>
              <input type="text" max="299" name="title" class="form-control" placeholder="Гарчигаа оруулна уу">
            </div>
            <div class="form-group">
              <label>Арга хэмжээ болох өдөр</label>
              <input class=" form-control datepicker" name="eventdate" data-date-format="yyyy.mm.dd">
            </div>
            <div class="form-group">
              <label>Нүүрэнд харагдах зураг</label>
              <input type="file" name="eventimage">
            </div>
            <div class="form-group">
              <label>Агуулга</label>
              <textarea class="textarea form-control" name="content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Арга хэмжээ бүртгэх</button>
            </div>
          </form>
          </div>
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
<script src="/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
$(function(){
  $(".textarea").wysihtml5({
    toolbar: {
      "font-styles": false, // Font styling, e.g. h1, h2, etc.
      "emphasis": true, // Italics, bold, etc.
      "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
      "html": false, // Button which allows you to edit the generated HTML.
      "link": false, // Button to insert a link.
      "image": false, // Button to insert an image.
      "color": false, // Button to change color of font
      "blockquote": true, // Blockquote
    }
  });
  $("#_eventx").addClass("active");
  $('.datepicker').datepicker({
      format: 'yyyy.mm.dd',
  });
  $('.datepicker').on('changeDate', function(ev){
    $(this).datepicker('hide');
});
});
</script>
@endsection
