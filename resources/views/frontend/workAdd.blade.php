@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
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
    $("#menu_add_work").addClass('active');
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

    function readURL(input) {

        if (input.files && input.files[0]) {
          $(input.files).each(function () {
            var reader = new FileReader();
            reader.readAsDataURL(this);
            reader.onload = function (e) {
                var extention = e.target.result.split('/');
                if('data:image' === extention[0]){
                    $('#img_'+$(input).data('id')).attr('src', e.target.result);
                }else{
                  alert("Зөвхөн зурган файл оруулна уу");
                  return;
                }
            }
          });
        }
    }


    $('#workfile').on('change', function(){
      var filename = $(this).val().split('\\').pop();
      $('#uploadfilename').html(filename);
    });

    $('.modal-backdrop').remove();
    $('.datepicker').datepicker({
       format: 'yyyy-mm-dd'
     }).on('changeDate', function(e){
        $(this).datepicker('hide');
    });
  });

</script>
@endsection
@section('content')
<div class="container page-content">

  <div class="row">
    @include('frontend.workMenu')
      <div class="col-md-7 animated fadeInRight">
        @include('status')
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">{{trans('strings.add_work')}}</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <form action="{{route('workAction')}}" enctype="multipart/form-data" method="post" id="addForm">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="action" value="creatework">
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.project_name')}}
                  </div>
                  <div class="col-md-9 @if($errors->add->first('project_name') !== "") has-error has-feedback @endif">
                    @if($errors->add->first('project_name') !== "")<label class="control-label" > {{$errors->add->first('project_name')}} </label>@endif
                    <input type="text" class="form-control input-sm" id="prject_name" name="project_name" placeholder="{{trans('strings.project_name')}}...">
                  </div>
              </div>
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.reference')}}
                  </div>
                  <div class="col-md-9 @if($errors->add->first('reference') !== "") has-error has-feedback @endif">
                    @if($errors->add->first('reference') !== "")<label class="control-label" > {{$errors->add->first('reference')}} </label>@endif
                    <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="reference" name="reference"></textarea>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3">
                  </div>
                  <div class="col-md-9 @if($errors->add->first('workimages') !== "") has-error has-feedback @endif">
                    @if($errors->add->first('workimages') !== "")<label class="control-label" > {{$errors->add->first('workimages')}} </label><br/>@endif

                    <div id="workImages">
                    </div>
                    <a><span class="file-input btn btn-azure btn-file" id="addImage">Зураг нэмэх</span></a>
                  </div>
              </div><br/>
              <!--<div class="row">
                  <div class="col-md-3">
                  </div>
                  <div class="col-md-9 @if($errors->add->first('workfile') !== "") has-error has-feedback @endif">
                    @if($errors->add->first('workfile') !== "")<label class="control-label" > {{$errors->add->first('workfile')}} </label><br/>@endif
                    <a><span class="file-input btn btn-azure btn-file"><input type="file" id="workfile"  name="workfile"> Файл нэмэх</span></a>&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-info"></i>
                    <i>Файлын хэмжээ хамгийн ихдээ 20mb байна.</i><br/>
                    <span class="text-info" id="uploadfilename"></span>
                  </div>
              </div>-->
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.section')}}
                  </div>
                  <div class="col-md-9">
                      <div class="row">
                        @foreach($sections as $item)
                          <div class="col-md-6">
                            <label>
                                <input value="{{$item->id}}"  type="checkbox" class="colored-blue selectsection">
                                <span class="text">{{$item->secTrans('mn')->name}}</span>
                            </label>
                          </div>
                        @endforeach
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

                      </div>
                  </div>
              </div>
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.your_skill')}}
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" placeholder="{{trans('strings.your_skill')}}..." rows="5" name="your_skill" id="your_skill"></textarea>
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
                        <input value="1" name="is_active" type="checkbox" class="colored-blue"><br/>
                        <span class="text">{{trans('strings.show_work')}}</span>
                    </label>
                  </div>
              </div>
              <hr/>
              <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-9">
                  <button class="btn btn-default purple"><i class="fa fa-plus"></i> {{trans('strings.add_work')}}</button>
                </div>
              </div>
            </div>
          </form>
          </div>

      </div>
  </div>

</div>
@endsection
