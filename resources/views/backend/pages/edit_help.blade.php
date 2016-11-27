@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>&nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-question-circle"></i> Тусламж</a></li>
      <li class="active">асуулт хариулт засах</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      @include('status')
      <div class="row">
        @if (count($errors) > 0)
        <div class="col-md-12">
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        </div>
  @endif

      </div>
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <form method="post" action="{{route('adminActionPages')}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="action" value="edit_help">
              <input type="hidden" name="helpid" value="{{$help->id}}">
            <div class="form-group">
              <label>Дараалал</label>
              <input name="order_id" id="order_id" value="{{$help->order_id}}" type="number" value="0" class="form-control">
            </div>
            <div class="form-group">
              <label>Асуулт</label>
              <input type="text" name="questions" class="form-control" value="{{$help->questions}}" placeholder="Энэ хэсэлт асуулт оруулна">
            </div>
            <div class="form-group">
              <label>Хариулт</label>
              <textarea class="textarea form-control" name="answers" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!$help->answers!!}</textarea>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Тусламж хадгалах</button>
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
  $("#_help").addClass("open active");
  $("#_help_list").addClass("active");

});
</script>
@endsection
