<div class="modal fade" id="salary_contract" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Цалин илгээх форм</h4>
      </div>
      <form action="{{ route('salaryAction') }}" enctype="multipart/form-data" method="POST" id="txnForm">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="action" value="txn">
        <input type="hidden" name="workid" value="{{$work->id}}">
        <input type="hidden" name="receive_user_id" id="receive_user_id">
        <input type="hidden" name="proposalid" id="proposalid">
      <div class="modal-body">
        <div class="widget">

          <div class="widget-body bordered-top">
            <div class="widget-header">
              <h3 class="widget-caption">Ажил захиалагч</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="form-group fmd">
                <span>Байгууллагын нэр</span>
                <input class="form-control" name="company_name" id="company_name" type="text" placeholder="Ажил захиалагч байгууллагын нэр...">
              </div>
              <div class="form-group fmd">
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
                <div class="col-md-10 fmd">
                      <input class="form-control" name="last_name" id="last_name" type="text" placeholder="{{trans('strings.last_name')}}...">
                </div>
              </div>
              <div class="row"><br/>
                <div class="col-md-2">
                  <span>{{trans('strings.first_name')}}</label>
                </div>
                <div class="col-md-10 fmd">
                  <input class="form-control" name="first_name" id="first_name" type="text" placeholder="{{trans('strings.first_name')}}...">
                </div>
              </div>
              <div class="row"><br/>
                <div class="col-md-2">
                  <span>Регистр</label>
                </div>
                <div class="col-md-10 fmd">
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
                <div class="col-md-9 fmd">
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
                <div class="col-md-9 fmd">
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
                <div class="col-md-9 fmd">
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
                  <span>Үйлчилгээний шимтгэл</span>
                </div>
                <div class="col-md-6">
                  <input class="form-control" readonly="true" name="fee_txn" id="fee_txn" type="text" value="1500">
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
                  <p>Монгол улсад хүчин төгөлдөр мөрдөгдөж буй ХАОАТ, НДШ, ЭМД, НӨАТ-ийн тухай хуулийн дагуу гүйлгээ хийх тул ажил гүйцэтгэгчийн гарт олгогдох цалинг болон захиалагч таниас гарах мөнгөн дүнг урьдчилан тооцоолж, Ажил гүйцэтгэгч болон Захиалагч талууд харилцан тохиролцсон байх ёстойг хүлээн зөвшөөрнө үү.</p>
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
