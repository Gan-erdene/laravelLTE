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
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Секци монгол хэл дээр</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <div class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="secname" class="col-sm-2 control-label">Секци</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="secname" name="secname">
                </div>
              </div>
              <div class="form-group">
                <label for="secdesc" class="col-sm-2 control-label">Тайлбар</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="secdesc" name="secdesc">
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Секци англи хэл дээр</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="secname1" class="col-sm-2 control-label">Секци</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="secname1" name="secname1">
                  </div>
                </div>
                <div class="form-group">
                  <label for="secdesc1" class="col-sm-2 control-label">Тайлбар</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="secdesc1" name="secdesc1">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box box-info">
              <!-- /.box-header -->
              <!-- form start -->
              <div class="form-horizontal">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Харуулах эсэх</label>

                    <div class="col-sm-10">
                      <input type="checkbox" class="flat-red" checked>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Тайлбар</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Агуулга</label>

                    <div class="col-sm-3">
                      <select class="form-control">
                          <option></option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-info pull-right">Sign in</button>
                </div>
                <!-- /.box-footer -->
              </div>
            </div>
    </div>

  </section>
  <!-- /.content -->
</div>

@endsection
@section('javascript')
<script>
//Flat red color scheme for iCheck
 $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
   checkboxClass: 'icheckbox_flat-green',
   radioClass: 'iradio_flat-green'
 });
</script>
@endsection
