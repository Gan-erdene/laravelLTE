@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="/frontend/assets/js/jquery.1.11.0.validate.min.js"></script>
<script src="/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
  $(document).on('change', '.selectsection', function(){
    if(this.checked){
        $.post("{{route('workAction')}}", {'_token':"{{ csrf_token() }}",
          action:'category', section_id:this.value
        }, function(data){
            $('#cat_container').append(data.html);
        });
    }else{
      $('.sec_'+this.value).remove();
    }
  });

  $(document).ready(function () {

    $('#addImage').on('click', function(){
      var id = new Date().getTime();
      var old = $('#workImages').html();
      var newhtml = "<div id='div_"+id+"' class='row'><a class='col-md-11'><span class='file-input btn btn-default btn-block btn-file'><input type='file' name='workimages[]' multiple data-id='"+id+"' class='imgInp'>Зурагаа оруулна уу</span></a><a class='btn btn-default btn-sm icon-only removeimage' data-id='"+id+"' ><i class='fa fa-times'></i></a><div class='col-md-12'><img id='img_"+id+"' style='max-width:100%' src='/frontend/img/icon-edit.png' alt='Зурагаа оруулна уу.' /></div></div>";
      $('#workImages').append(newhtml);

      $(".imgInp").change(function(){
          readURL(this);
      });

      $('.removeimage').on('click', function(){
        var id=$(this).data('id');
        $('#div_'+id).remove();
      });
    });

    $(".imgInp").change(function(){
        readURL(this);
    });

    $('.removeimage').on('click', function(){
      var id=$(this).data('id');
      $('#div_'+id).remove();
    });

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
    $('#project_name').val('{{$work->project_name}}');
    $('#price').val('{{$work->price}}');
    $('#phone').val('{{$work->phone}}');
    @if($work->is_active === 1)
    $('#is_active').attr("checked", "checked");
    @endif

    $('.datepicker').datepicker({
       format: 'yyyy-mm-dd'
     }).on('changeDate', function(e){
        $(this).datepicker('hide');
    });

    $('#startdate').datepicker( "setDate", new Date({{date('Y,m,d', strtotime($work->startdate))}}) );
    $('#enddate').datepicker( "setDate", new Date({{date('Y,m,d', strtotime($work->enddate))}}) );
  });
</script>
@endsection
@section('content')
<div class="container page-content">

  <div class="row"><div class="col-md-3"></div>
      <div class="col-md-7 animated fadeInRight">
        @include('status')
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">{{trans('strings.add_work')}}</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <form action="{{route('workAction')}}" method="post" id="addForm">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="action" value="save">
              <input type="hidden" name="workid" value="{{$work->id}}">
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.project_name')}}
                  </div>
                  <div class="col-md-9 @if($errors->add->first('project_name') !== "") has-error has-feedback @endif">
                    @if($errors->add->first('project_name') !== "")<label class="control-label" > {{$errors->add->first('project_name')}} </label>@endif
                    <input type="text" class="form-control input-sm" id="project_name" name="project_name" placeholder="{{trans('strings.project_name')}}...">
                  </div>
              </div>
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.reference')}}
                  </div>
                  <div class="col-md-9 @if($errors->add->first('reference') !== "") has-error has-feedback @endif">
                    @if($errors->add->first('reference') !== "")<label class="control-label" > {{$errors->add->first('reference')}} </label>@endif
                    <textarea class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"  id="reference" name="reference">{!!$work->reference!!}</textarea>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3">
                  </div>
                  <div class="col-md-9 @if($errors->add->first('workimages') !== "") has-error has-feedback @endif">
                    @if($errors->add->first('workimages') !== "")<label class="control-label" > {{$errors->add->first('workimages')}} </label><br/>@endif

                    <div id="workImages">
                      @foreach($work->images() as $image)
                      <div id='div_{{$image->timestamp}}' class='row'><a class='col-md-11'><span class='file-input btn btn-default btn-block btn-file'><input type='file' name='workimages[]' multiple data-id='{{$image->timestamp}}' class='imgInp'>Зурагаа оруулна уу</span></a><a class='btn btn-default btn-sm icon-only removeimage' data-id='{{$image->timestamp}}' ><i class='fa fa-times'></i></a><div class='col-md-12'><img id='img_{{$image->timestamp}}' style='max-width:100%' src='/uploads/work/{{$image->timestamp}}.{{$image->extension}}' alt='Зурагаа оруулна уу.' /></div></div>
                      @endforeach
                    </div>
                    <a><span class="file-input btn btn-azure btn-file" id="addImage">Зураг нэмэх</span></a>
                  </div>
              </div><br/>
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.section')}}
                  </div>
                  <div class="col-md-9">
                      <div class="row">
                        @include('section.sectionItem')
                      </div>
                  </div>
              </div>
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.category')}}
                  </div>
                  <div class="col-md-9">
                      <div class="row" id="cat_container">
                        @include('category.categoryItem')
                      </div>
                  </div>
              </div>
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.your_skill')}}
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" placeholder="{{trans('strings.your_skill')}}..." rows="5" name="your_skill" id="your_skill">{{$work->skill}}</textarea>
                  </div>
              </div>
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    Холбоо барих утас
                  </div>
                  <div class="col-md-9">
                    <input class="form-control" name="phone" id="phone" type="text" placeholder="xxxxxxxx, xxxxxxxx...">
                  </div>
              </div><br/>
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.price')}}
                  </div>
                  <div class="col-md-9">
                    <input type="text" placeholder="{{trans('strings.price')}}..." class="form-control input-sm" id="price" name="price">
                  </div>
              </div><br/>
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.startdate')}}
                  </div>
                  <div class="col-md-9 @if($errors->add->first('startdate') !== "") has-error has-feedback @endif">
                    @if($errors->add->first('startdate') !== "")<label class="control-label" > {{$errors->add->first('startdate')}} </label>@endif
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control datepicker" id="startdate" name="startdate" placeholder="Он, Сар, Өдөр">
                    </div>
                  </div>
              </div><br/>

              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.enddate')}}
                  </div>
                  <div class="col-md-9 @if($errors->add->first('enddate') !== "") has-error has-feedback @endif">
                    @if($errors->add->first('enddate') !== "")<label class="control-label" > {{$errors->add->first('enddate')}} </label>@endif
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control datepicker" id="enddate" name="enddate" placeholder="Он, Сар, Өдөр">
                    </div>
                    <label>
                        <input value="1" name="is_active" id="is_active" type="checkbox" class="colored-blue"><br/>
                        <span class="text">{{trans('strings.show_work')}}</span>
                    </label>
                  </div>
              </div> <hr/>
              <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-9">
                  <a href="{{route('listWork')}}" class="btn btn-default purple"><i class="fa fa-back"></i> {{trans('strings.back')}}</a>
                  <button class="btn btn-success purple"><i class="fa fa-save"></i> {{trans('strings.save')}}</button>
                </div>
              </div>
            </div>
          </form>
          </div>
      </div>
  </div>

</div>
@endsection
