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
    $('#project_name').val('{{$work->project_name}}');
    $('#price').val('{{$work->price}}');
    $('#duration_type').val('{{$work->duration_type}}');
    $('#duration').val('{{$work->duration}}');
    @if($work->is_active === 1)
    $('#is_active').attr("checked", "checked");
    @endif
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
                        @foreach($sections as $item)
                          <div class="col-md-6">
                            <label>
                                <input value="{{$item->id}}" @if(is_numeric($item->section_id)) checked="checked" @endif  type="checkbox" class="colored-blue selectsection">
                                <span class="text">{{$item->section_name}}</span>
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
                        @foreach($categories as $category)
                          <div class="col-md-6 sec_{{$category->section_id}}">
                            <label>
                                <input value="{{$category->id}}" @if(is_numeric($category->catid)) checked="checked" @endif name="categories[]" type="checkbox" class="colored-blue">
                                <span class="text">{{$category->catname}}</span>
                            </label>
                          </div>
                        @endforeach
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
                    {{trans('strings.duration_type')}}
                  </div>
                  <div class="col-md-9">
                    <select name="duration_type" id="duration_type">
                        <option value="h">{{trans('strings.hour')}}</option>
                        <option value="d">{{trans('strings.day')}}</option>
                        <option value="m">{{trans('strings.month')}}</option>
                        <option value="y">{{trans('strings.year')}}</option>
                    </select>
                  </div>
              </div><br/>

              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.duration')}}
                  </div>
                  <div class="col-md-9">
                    <input type="text" placeholder="{{trans('strings.duration')}}..." class="form-control input-sm" id="duration" name="duration">
                    <label>
                        <input value="1" id="is_active" name="is_active" type="checkbox" class="colored-blue"><br/>
                        <span class="text">{{trans('strings.show_work')}}</span>
                    </label>
                  </div>
              </div>
              <hr/>
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
