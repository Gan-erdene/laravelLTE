@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
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
    $('#project_name').val('{{$work->project_name}}');
    $('#price').val('{{$work->price}}');
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
                    <textarea class="form-control" placeholder="{{trans('strings.reference')}}..." rows="5" id="reference" name="reference">{{$work->reference}}</textarea>
                  </div>
              </div>
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
