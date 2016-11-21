@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Шинэ мэдээ нэмэх
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Мэдээ</a></li>
      <li><a href="#">Мэдээлэл</a></li>
      <li class="active">Шинээр үүсгэх</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-default">
      @include('status')
    <div class="row">
      <!-- left column -->

      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-6">




          <div class="box-body">
            <form role="form" method="POST" action="{{ url('/backend/content/index') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                <label>Section</label>
                  <select class="form-control" id="section_id" name="section_id">
                    @foreach($section as $sections)
                      <option value="{{$sections->id}}">{{$sections->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label for="secdesc" class="col-sm-3 control-label">Ангилал</label>

                <div class="col-sm-9">
                <div class="checkbox" id="catlist">
                  @foreach($category as $categories)
                  <label>
                    <input type="checkbox" id="checkbox" name="checkbox" value="{{ $categories->id}}">
                    {{ $categories->CategoryTranslationJoin()->where('lang','mn')->first()->name}}
                  </label>
                  @endforeach
                </div>
              </div>

              </div>
              <div class="form-group">
                <label>Гарчиг</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Нэр ...">
              </div>

              <div class="form-group">
                <label>Товч текст</label>
                <textarea class="form-control" id="descripion" name="description" rows="3" placeholder="Тайлбар ..."></textarea>
                <input type="hidden" class="form-control" id="catlang" name="catlang" value="mn">
              </div>

              <div class="form-group">
                <label>Бүрэн текст</label>
                <textarea class="form-control" id="descripion" name="description" rows="3" placeholder="Тайлбар ..."></textarea>
                <input type="hidden" class="form-control" id="catlang" name="catlang" value="mn">
              </div>

              <div class="form-group">
                <label>Секци</label>
                <select class="form-control" id="section_id" name="section_id">

                    <option value="1"></option>

                </select>
              </div>
              <!-- select -->

              <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="checkbox" name="checkbox" value="1">
                    Харуулах
                  </label>
                </div>

              </div>
              <div class="form-group">
                <label>Дэс дугаар</label>
                <input type="text" name="order_id" class="form-control" placeholder="Дэс дугаар ...">
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Хадгалах, Нэмэх</button>
              </div>
            </form>


        </div>
      </div>

    </div>
    </div>
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
</script>
<script>
$(function(){
  $("#_info").addClass("open active");
  $("#_category").addClass("active");
  $("#category_add").addClass("active");
  $('#example1').DataTable();

  $('#section_id').on('change', function(){
      $.post("/backend/category/action", {'_token':"{{ csrf_token() }}", action:'cat', section_id:this.value}, function(data){
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
