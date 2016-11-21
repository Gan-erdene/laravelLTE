<div class="box profile-info n-border-top">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab-post" data-toggle="tab">Мэдээ</a></li>
    <li><a href="#tab-timeline" data-toggle="tab">Хийх ажлаа оруулах</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade in active" id="tab-post">
      <form action="{{ url('/frontend/home/post') }}"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <textarea class="form-control input-lg p-text-area" id="fulltext" name="fulltext" rows="body" placeholder="Юу бодож байна?"></textarea>
        <div class="box-footer box-form">
          <button type="submit" class="btn btn-azure pull-right">Нийтлэх</button>
          <ul class="nav nav-pills">
            <li><a href="#"></a></li>
          </ul>
        </div>
      </form>
    </div><!-- end post state form -->
    <div class="tab-pane fade" id="tab-timeline">

        <textarea data-toggle="modal" href="#myModal" class="form-control input-lg p-text-area"  rows="2" placeholder="Whats in your mind today?">

        </textarea>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Хийх ажлаа оруулах</h4>
              </div>
              <form action="{{ url('/frontend/home/action') }}"enctype="multipart/form-data" method="POST">

              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="action" value="creatework">
              <div class="modal-body">

                <div class="widget">

                  <div class="widget-body bordered-top bordered-sky">


                    <div class="row">
                        <div class="col-md-3">
                        Гарчиг
                        </div>
                        <div class="col-md-9 @if($errors->add->first('project_name') !== "") has-error has-feedback @endif">
                          @if($errors->add->first('project_name') !== "")<label class="control-label" > {{$errors->add->first('project_name')}} </label>@endif
                          <input type="text" class="form-control input-sm" id="title" name="title" placeholder="Хийх ажлаа оруулах...">
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-3">
                          {{trans('strings.your_skill')}}
                        </div>
                        <div class="col-md-9 @if($errors->add->first('reference') !== "") has-error has-feedback @endif">
                          @if($errors->add->first('reference') !== "")<label class="control-label" > {{$errors->add->first('reference')}} </label>@endif
                          <textarea class="form-control" placeholder="Хийх ажлын тухай товчхон оруулах..." rows="5" id="body" name="body"></textarea>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-3">
                          {{trans('strings.section')}}
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                              @foreach($sections as $section)
                                <div class="col-md-6">
                                  <label>
                                      <input value="{{$section->id}}"  type="checkbox" class="colored-blue selectsection">
                                      <span class="text">{{$section->secTrans('mn')->name}}</span>
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
                          {{trans('strings.price')}}
                        </div>
                        <div class="col-md-9">
                          <input type="text" placeholder="{{trans('strings.price')}}..." class="form-control input-sm" id="price" name="price">
                        </div>
                    </div><br/>
                    <div class="row">
                      <div class="col-md-3">

                      </div>
                      <div class="col-md-9">
                        <a><span class="file-input btn btn-azure btn-file"><input type="file" id="imagename" name="imagename" multiple="" /> Файл нэмэх</a>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                <button type="submit" class="btn btn-primary">Хадгалах</button>
              </div>
            </form>
            </div>
          </div>
        </div>
        <div class="box-footer box-form">
          <button type="button" class="btn btn-azure pull-right">Нийтлэх</button>
          <ul class="nav nav-pills">
            <li><a href="#"></a></li>
          </ul>
        </div>
    </div>
  </div>
</div>
