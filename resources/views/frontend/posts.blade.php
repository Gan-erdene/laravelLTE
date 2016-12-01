<div class="box profile-info n-border-top">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab-post" data-toggle="tab">Мэдээ</a></li>
    <li><a href="#tab-timeline" data-toggle="tab">Хийх ажлаа оруулах</a></li>
    <li><a href="#_addwork" data-toggle="tab">Шинэ ажил оруулах</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade in active" id="tab-post">
      <form action="{{ url('/frontend/home/post') }}"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <textarea class="form-control input-lg p-text-area" id="fulltext" name="fulltext" rows="body" placeholder="Юу бодож байна?"></textarea>
        <img id="myPostimage" style="max-width:100%">
        <div class="box-footer box-form">
          <button type="submit" class="btn btn-azure pull-right">Нийтлэх</button>
          <ul class="nav nav-pills">
           <li><a onclick="document.getElementById('upload').click(); return true"><i class="fa fa-image"> </i><input type="file" id="upload" name="upload" style="visibility: hidden; width: 1px; height: 1px" multiple /></a></li>
            <li><a href="#"><i class=" fa fa-film"></i></a></li>
          </ul>
        </div>
      </form>
    </div><!-- end post state form -->
    <div class="tab-pane fade" id="tab-timeline">

        <textarea type="textarea" placeholder="Хийх ажлаа оруулна уу" data-toggle="modal" href="#myModal" class="form-control input-lg p-text-area" rows="2"></textarea>

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
    <div class="tab-pane fade" id="_addwork">

        <textarea type="textarea" placeholder="Та ажил оруулахуу" data-toggle="modal" href="#addWorkModal" class="form-control input-lg p-text-area" rows="2"></textarea>

        <div class="modal fade" id="addWorkModal" tabindex="-1" role="dialog" aria-labelledby="addWorkModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="addWorkModalLabel">Ажил нэмэх</h4>
              </div>

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
                          <div class="row cat_container">

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
        <div class="box-footer box-form">
          <button type="button" class="btn btn-azure pull-right">Нийтлэх</button>
          <ul class="nav nav-pills">
            <li><a href="#"></a></li>
          </ul>
        </div>
    </div>
  </div>
</div>
