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
      @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    </div>
    <div class="row">
      <div class="col-lg-6 ">
        <form id="sectionForm" method="post" action="{{ url('/home/section/action') }}" class="form-horizontal">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="action" id="action" value="create">
        <input type="hidden" name="id" id="id">
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
                  <button id="btnCancel"  class="btn btn-default" style="display:none"> Болих </button>
                  <button id="btnCreate" type="submit" class="btn btn-info pull-right"> Бүртгэх</button>
                  <button id="btnSave" type="submit" class="btn btn-success pull-right" style="display:none"> <i class="fa fa-save"></i> Хадгалах</button>
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
                  <th>Үйлдэл</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sectionlist as $item)
                <tr>
                  <td>{{$item->secTrans('mn')->name}}</td>
                  <td>{{$item->secTrans('mn')->description}}</td>
                  <td><i class="fa {{$item->isPublished()}}"></i></td>
                  <td>{{ $item->sectype->name }}</td>
                  <td>{{$item->order_id}}</td>
                  <td>
                    <button id="{{$item->id}}" type="button" class="btn btn-primary btn-xs btnedit" >
                      <i class="fa fa-edit"></i> Засах
                    </button>
                    <button data-id="{{$item->id}}" data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-xs announce" >
                      <i class="fa fa-trash"></i> Устгах
                    </button>
                  </td>
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

    <div class="example-modal">
        <div class="modal modal-danger"  id="myModal">
          <div class="modal-dialog">
            <form method="post" class="modal-content" action="/home/section/action">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="deleteid" id="deleteid">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Устгах цонх</h4>
              </div>
              <div class="modal-body">
                <p>Та устгахдаа итгэлтэй байна уу ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"> Болих </button>
                <button type="submit" class="btn btn-outline"> Устгах </button>
              </div>
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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

    $('.btnedit').click(function(){
      $.post('/home/section/action', {'_token':"{{ csrf_token() }}", 'action':'section', 'id':$(this).attr("id")}, function(data){
          $('#secname').val(data.translation.name);
          $('#secdesc').val(data.translation.description);
          $('#published').prop('checked', data.section.published == 1 ? true : false);
          $('#sectype').val(data.section.type_id);
          $('#secorder').val(data.section.order_id);
          $("#action").val("edit");
          $("#id").val(data.section.id);

          $('#btnCancel').show();
          $('#btnSave').show();
          $('#btnCreate').hide();

      });
    });

    $("#btnCancel").on('click', function(e){
      e.preventDefault();
      $('#btnCancel').hide();
      $('#btnSave').hide();
      $('#btnCreate').show();
      $("#action").val("create");
      $('#sectionForm')[0].reset();
    });

    $(".announce").click(function(){ // Click to only happen on announce links
       $("#deleteid").val($(this).data('id'));
     });
});
</script>
@endsection
