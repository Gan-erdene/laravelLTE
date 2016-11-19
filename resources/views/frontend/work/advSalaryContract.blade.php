<div class="modal fade" id="salary_contract" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Цалин олгох форм</h4>
      </div>
      <form action="{{ route('workAction') }}"enctype="multipart/form-data" method="POST">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="action" value="confirm_proposal">
        <input type="hidden" name="workid" value="{{$work->id}}">
      <div class="modal-body">
        <div class="widget">

          <div class="widget-body bordered-top">
            <div class="widget-header">
              <h3 class="widget-caption">Ажил захиалагч</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="form-group">
                <span>Байгууллагын нэр</span>
                <input class="form-control" name="company_name" id="company_name" type="text" placeholder="Ажил захиалагч байгууллагын нэр...">
              </div>
              <div class="form-group">
                <span>Гүйцэтгэх ажлын утга</span>
                <input class="form-control" name="work_name" id="work_name" type="text" placeholder="Гүйцэтгэх ажлын утга...">
              </div>
            </div>

            <div class="widget-header">
              <h3 class="widget-caption">Ажил гүйцэтгэгч</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky form-horizontal">
              <div class="row">
                <div class="col-md-2">
                  <label class="control-label" for="company_name">{{trans('strings.last_name')}}</label>
                </div>
                <div class="col-md-10">
                      <input class="form-control" name="last_name" id="last_name" type="text" placeholder="{{trans('strings.last_name')}}...">
                </div>
              </div>
              <div class="row"><br/>
                <div class="col-md-2">
                  <span>{{trans('strings.first_name')}}</label>
                </div>
                <div class="col-md-10">
                  <input class="form-control" name="first_name" id="first_name" type="text" placeholder="{{trans('strings.first_name')}}...">
                </div>
              </div>
              <div class="row"><br/>
                <div class="col-md-2">
                  <span>Регистр</label>
                </div>
                <div class="col-md-10">
                  <input class="form-control" name="regnum" id="regnum" type="text" placeholder="Регистр...">
                </div>
              </div>
            </div>

            <!-----  ajliin medeelel end bna ----->
            <div class="widget-header">
              <h3 class="widget-caption">Ажил</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky form-horizontal">
              <div class="row">
                <div class="col-md-3">
                  <span>{{trans('strings.startdate')}}</span>
                </div>
                <div class="col-md-9">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control datepicker" id="startdate" name="startdate" placeholder="Он, Сар, Өдөр">
                  </div>
                </div>
              </div>
              <div class="row"><br/>
                <div class="col-md-3">
                  <span>{{trans('strings.enddate')}}</span>
                </div>
                <div class="col-md-9">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control datepicker" id="enddate" name="enddate" placeholder="Он, Сар, Өдөр">
                  </div>
                </div>
              </div>
              <div class="row"><br/>
                <div class="col-md-3">
                  <span>Цалин</span>
                </div>
                <div class="col-md-9">
                  <input class="form-control" name="salary" id="salary" type="text" placeholder="Цалин...">
                </div>
              </div>
              <div class="row"><br/>
                <div class="col-md-6">
                  <span>Байгууллагаас төлөх ндш 11%</span>
                </div>
                <div class="col-md-6">
                  <input class="form-control" readonly="true" name="fee_nd" id="fee_nd" type="text" placeholder="Байгууллагаас төлөх ндш 11%...">
                </div>
              </div>
              <div class="row"><br/>
                <div class="col-md-6">
                  <span>НӨАТ 10%</span>
                </div>
                <div class="col-md-6">
                  <input class="form-control" readonly="true" name="fee_noat" id="fee_noat" type="text" placeholder="НӨАТ 10%...">
                </div>
              </div>
              <div class="row"><br/>
                <div class="col-md-6">
                  <span>Сүлжээний дансанд шилжүүлэх төлбөр буюу нийт дүн</span>
                </div>
                <div class="col-md-6">
                  <input class="form-control" readonly="true" name="txnvalue" id="txnvalue" type="text" placeholder="Нийт дүн...">
                </div>
              </div>
            </div><hr/>
            <div class="widget-body bordered-top bordered-sky form-horizontal">
              <div class="row">
                  <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                  <div class="checkbox">
                      <label>
                          <input id="salary_agreement" name="salary_agreement" type="checkbox" class="colored-blue">
                          <span class="text">Та манай нөхцөлийг зөвшөөрч байна уу ?</span>
                      </label>
                  </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Үгүй</button>
        <button type="submit" id="btnContinue" disabled="true" class="btn btn-primary">Үргэлжлүүлэх</button>
      </div>
</form>
    </div>
  </div>
</div>
