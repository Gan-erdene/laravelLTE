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
      @include('status')
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
                <input type="hidden" class="form-control" id="catlang" name="catlang" value="mn">
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
      <div class="col-lg-6">
        <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Жагсаалт</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Нэр</th>
                  <th>Секци</th>
                  <th>Харуулах</th>
                  <th>Үйлдэл</th>

                </tr>
                </thead>
                <tbody>
                  @foreach($category as $categories)
                <tr>
                  <td>{{$categories->CategoryTranslationJoin->name}} </td>
                  <td>
                    {{ $categories->SectionTranslationJoin->secTrans('mn')->name}}
                  </td>
                  <td>{{$categories->published}}</td>
                  <td>
                    <button type="button" class="btn btn-primary btn-xs" style="margin-right: 5px;">
                      <i class="fa fa-edit"></i> Засах
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" style="margin-right: 5px;">
                      <i class="fa fa-edit"></i> Устгах
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
});
</script>
@endsection
