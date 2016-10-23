@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Шинэ ангилал үүсгэх
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Мэдээ</a></li>
      <li><a href="#">Ангилал</a></li>
      <li class="active">Шинээр үүсгэх</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->

      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-6">

        <div class="box box-warning">


          <div class="box-body">
            <form role="form" method="POST" action="{{ url('/home/category/create') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label>Нэр</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Нэр ...">
              </div>

              <div class="form-group">
                <label>Тайлбар</label>
                <textarea class="form-control" id="descripion" name="description" rows="3" placeholder="Тайлбар ..."></textarea>
              </div>

              <div class="form-group">
                <label>Секци</label>
                <select class="form-control" id="section_id" name="section_id">
                  @foreach($section as $sections)
                    <option value="{{$sections->id}}">{{$sections->name}}</option>
                  @endforeach
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
<script>
$(function(){
  $("#_info").addClass("open active");
  $("#_category").addClass("active");
  $("#category_add").addClass("active");
});
</script>
@endsection
