@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-newspaper-o"></i> Мэдээлэл</a></li>
      <li><a href="#">Секци</a></li>
      <li class="active">Нэмэх</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <form method="post" action="{{ url('/home/section/action') }}" class="form-horizontal">
      <div class="col-md-6 ">
        <input type="hidden" name="action" value="action">
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
              </div>
            </div>
            <div class="box-header with-border">
              <h3 class="box-title">Секци англи хэл дээр</h3>
            </div>
            <div class="form-group">
              <label for="secname1" class="col-sm-3 control-label">Секци</label>

              <div class="col-sm-9">
                <input type="text" class="form-control" id="secname1" name="secname1">
              </div>
            </div>
            <div class="form-group">
              <label for="secdesc1" class="col-sm-3 control-label">Тайлбар</label>

              <div class="col-sm-9">
                <input type="text" class="form-control" id="secdesc1" name="secdesc1">
              </div>
            </div>
            <div class="form-group">
              <label for="published" class="col-sm-3 control-label"></label>

              <div class="col-sm-9">
                <div class="checkbox">
                <label>
                  <input type="checkbox" name="published" id="published">
                  Харуулах
                </label>
              </div>
              </div>
            </div>

            <div class="form-group">
              <label for="sectype" class="col-sm-3 control-label">Агуулга</label>

              <div class="col-sm-3">
                <select name="sectype" id="sectype" class="form-control">
                    <option></option>
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
              </div>
      </form>
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
@endsection
