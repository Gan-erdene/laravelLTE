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
</script>
@endsection
@section('content')
<div class="container page-content">
  <div class="row">
    <div class="col-md-3">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="file-manager">
                    <div class="hr-line-dashed"></div>
                    <button class="btn btn-azure btn-block">Upload file</button>
                    <div class="hr-line-dashed"></div>
                    <h5>{{trans('strings.work')}}</h5>
                    <ul class="folder-list" style="padding: 0">
                        <li><a href=""><i class="fa fa-plus"></i> {{trans('strings.add_work')}}</a></li>
                        <li><a href=""><i class="fa fa-bars"></i> {{trans('strings.your_list_work')}}</a></li>
                        <li><a href=""><i class="fa fa-check"></i> {{trans('strings.your_complete_work')}}</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
      </div>
      <div class="col-md-7 animated fadeInRight">
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">Ажил оруулах</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="row">
                  <div class="col-md-3">
                    Project name
                  </div>
                  <div class="col-md-9">
                    <input type="text" class="form-control input-sm" id="sminput" placeholder="Project name...">
                  </div>
              </div>
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    Reference
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" placeholder="Reference..." rows="5" id="comment"></textarea>
                  </div>
              </div>
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    section
                  </div>
                  <div class="col-md-9">
                      <div class="row">
                        @foreach($sections as $item)
                          <div class="col-md-6">
                            <label>
                                <input value="{{$item->id}}" name="sections[]" type="checkbox" class="colored-blue selectsection">
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
                    Category
                  </div>
                  <div class="col-md-9">
                      <div class="row" id="cat_container">

                      </div>
                  </div>
              </div>
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    Your skill
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" placeholder="Your skill..." rows="5" id="comment"></textarea>
                  </div>
              </div>
              <hr/>
              <div class="row">
                  <div class="col-md-3">
                    Price
                  </div>
                  <div class="col-md-9">
                    <input type="text" placeholder="Price" class="form-control input-sm" id="sminput" placeholder="Small Input">
                  </div>
              </div><br/>
              <div class="row">
                  <div class="col-md-3">
                    duration type
                  </div>
                  <div class="col-md-9">
                    <select name="duration_type">
                        <option value="h">Цаг</option>
                        <option value="d">Өдөр</option>
                        <option value="m">Сар</option>
                        <option value="y">Жил</option>
                    </select>
                  </div>
              </div><br/>

              <div class="row">
                  <div class="col-md-3">
                    duration
                  </div>
                  <div class="col-md-9">
                    <input type="text" placeholder="Price" class="form-control input-sm" id="sminput" placeholder="Small Input">
                  </div>
              </div>
              <hr/>
              <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-9">
                  <button class="btn btn-default purple"><i class="fa fa-plus"></i> Create project</button>
                </div>
              </div>
            </div>
          </div>
      </div>
  </div>

</div>
@endsection
