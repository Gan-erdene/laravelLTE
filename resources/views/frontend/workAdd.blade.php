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
  });
</script>
@endsection
@section('content')
<div class="container page-content">
  @include('status')
  <div class="row">
    @include('frontend.workMenu')
      <div class="col-md-7 animated fadeInRight">
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">{{trans('strings.add_work')}}</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <form action="{{route('workAction')}}" method="post" id="addForm">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="action" value="creatework">
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.project_name')}}
                  </div>
                  <div class="col-md-9">
                    <input type="text" class="form-control input-sm" id="prject_name" name="project_name" placeholder="{{trans('strings.project_name')}}...">
                  </div>
              </div>
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    {{trans('strings.reference')}}
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" placeholder="{{trans('strings.reference')}}..." rows="5" id="reference" name="reference"></textarea>
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
