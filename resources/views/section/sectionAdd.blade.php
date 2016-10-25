@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
        Секци
        <small>Бүртгэл болон жагсаалт</small>
      </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-newspaper-o"></i> Мэдээлэл</a></li>
      <li><a href="#">Секци</a></li>
      <li class="active">Нэмэх</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    @include('status')
    <div class="row">
      <div class="col-lg-6 ">
        <form method="post" action="{{ url('/home/section/action') }}" class="form-horizontal">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="action" value="create">
        <div class="box box-info">
          <div class="box-body">
            <div class="box-header with-border">
              <h3 class="box-title">Секци монгол хэл дээр</h3>
            </div>
            <div class="form-group">
              <label for="secname" class="col-sm-3 control-label">Секци</label>

              <div class="col-sm-9">
                <input type="text" class="form-control" id="secname" name="secname">
              </div>
            </div>
            <div class="form-group">
              <label for="secdesc" class="col-sm-3 control-label">Тайлбар</label>

              <div class="col-sm-9">
                <input type="text" class="form-control" id="secdesc" name="secdesc">
                <input type="hidden" class="form-control" id="seclang" name="seclang" value="mn">
              </div>
            </div>

            <div class="form-group">
              <label for="published" class="col-sm-3 control-label"></label>

              <div class="col-sm-9">
                <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="published" id="published">
                  Харуулах
                </label>
              </div>
              </div>
            </div>

            <div class="form-group">
              <label for="sectype" class="col-sm-3 control-label">Агуулга</label>

              <div class="col-sm-3">
                <select name="sectype" id="sectype" class="form-control">
                  @foreach($sectiontypes as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="secorder" class="col-sm-3 control-label">Дараалал</label>

              <div class="col-sm-3">
                <input min="0" type="number" class="form-control" id="secorder" name="secorder">
              </div>
            </div>
                </div><!-- /.box-info -->
              </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-info pull-right"> Бүртгэх</button>
                </div>
                <!-- /.box-footer -->
                </form>
              </div>
      <div class="col-lg-6">
        <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Секци</th>
                  <th>Тайлбар</th>
                  <th>Харуулах</th>
                  <th>Агуулга</th>
                  <th>Дараалал</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sectionlist as $item)
                <tr>
                  <td>{{$item->secTrans('mn')->name}}</td>
                  <td>{{$item->secTrans('mn')->description}}</td>
                  <td>{{$item->isPublished()}}</td>
                  <td>{{ $item->sectype->name }}</td>
                  <td>{{$item->order_id}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>

@endsection
@section('javascript')
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
  $("#_section").addClass("active");
  $("#sectionadd").addClass("active");

  $('#example1').DataTable();
});
</script>
@endsection
