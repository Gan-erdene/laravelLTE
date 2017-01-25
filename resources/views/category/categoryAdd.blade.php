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
      <li><a href="#">Мэргэжил</a></li>
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
            <form role="form" method="POST" action="{{ url('/backend/category/action') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="action" id="action" value="create">
                  <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label>Нэр</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Нэр ...">
              </div>

              <div class="form-group">
                <label>Тайлбар</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Тайлбар ..."></textarea>
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
                <input type="text" name="order_id" id="order_id" class="form-control" placeholder="Дэс дугаар ...">
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
                  <td>{{isset($categories->CategoryTranslationJoin->name) ? $categories->CategoryTranslationJoin->name : ''}} </td>
                    <td>
                      {{ isset($categories->SectionTranslationJoin->secTrans('mn')->name) ? $categories->SectionTranslationJoin->secTrans('mn')->name : ''}}
                    </td>
                  <td>{{$categories->published}}</td>
                  <td>
                    <button data-id="{{$categories->id}}" type="button" class="btn btn-primary btn-xs btnedit" >
                      <i class="fa fa-edit"></i> Засах
                    </button>
                    <button data-id="{{$categories->id}}" data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-xs announce" >
                      <i class="fa fa-trash"></i> Устгах
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

      <div class="example-modal">
        <div class="modal modal-danger"  id="myModal">
          <div class="modal-dialog">
            <form method="post" class="modal-content" action="/backend/category/action">
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

  $('.btnedit').on('click',function(){
  $.post('/backend/category/action', {'_token':"{{ csrf_token() }}", 'action':'category', 'id':$(this).data('id')}, function(data){
      $('#name').val(data.translation.name);
      $('#description').val(data.translation.description);
      $('#checkbox').prop('checked', data.category.published == 1 ? true : false);
      $('#order_id').val(data.category.order_id);
      $("#action").val("edit");
      $("#section_id").val(data.category.section_id);
      $("#id").val(data.category.id);

      $('#btnCancel').show();
      $('#btnSave').show();
      $('#btnCreate').hide();

  });
});
    $('#example1').DataTable();

    $(".announce").click(function(){ // Click to only happen on announce links
       $("#deleteid").val($(this).data('id'));
     });
});
</script>
@endsection
