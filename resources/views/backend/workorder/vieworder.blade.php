@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-user"></i> Ажлын захиалга</a></li>
      <li class="active">Захиалгын жагсаалт</li>
      <li class="active">Захиалга</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      @include('status')
    <div class="row">
      <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Захиалгын дугаар: #{{$order->id}}</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="company_name" class="col-sm-3 control-label">Захиалагч байгууллагын нэр</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="company_name" value="{{$order->company_name}}">
                </div>
              </div>
              <div class="form-group">
                <label for="work_name" class="col-sm-3 control-label">Гүйцэтгэсэн ажлын утга</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="work_name" value="{{$order->work_name}}">
                </div>
              </div>
              <div class="form-group">
                <label for="first_name" class="col-sm-3 control-label">Хүл.авагч нэр</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="first_name" value="{{$order->first_name}}">
                </div>
              </div>
              <div class="form-group">
                <label for="first_name" class="col-sm-3 control-label">Хүл.авагч нэр</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="first_name" value="{{$order->first_name}}">
                </div>
              </div>
              <div class="form-group">
                <label for="created_at" class="col-sm-3 control-label">Захиалга илгээсэн огноо</label>
                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="created_at" value="{{date('Y.m.d H:i', strtotime($order->created_at))}}">
                </div>
              </div>
              @if($order->statuscode === 1)
              <div class="form-group">
                <label for="accepted_at" class="col-sm-3 control-label">Захиалга баталгаажуулсан огноо</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="accepted_at" value="{{date('Y.m.d H:i', strtotime($order->created_at))}}">
                </div>
              </div>
              @elseif($order->statuscode === 2)
              <div class="form-group">
                <label for="rejected_at" class="col-sm-3 control-label">Захиалга цуцалсан огноо</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="rejected_at" value="{{date('Y.m.d H:i', strtotime($order->created_at))}}">
                </div>
              </div>
              @endif
              <div class="form-group">
                <label for="salary" class="col-sm-3 control-label">Гарт олгох цалин</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="salary" value="{{$order->salary}}">
                </div>
              </div>
              <div class="form-group">
                <label for="fee_nd" class="col-sm-3 control-label">ЭМ, НДШ 10%</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="fee_nd" value="{{$order->fee_nd}}">
                </div>
              </div>
              <div class="form-group">
                <label for="fee_haoat" class="col-sm-3 control-label">ХАОАТ 10%</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="fee_haoat" value="{{$order->fee_haoat}}">
                </div>
              </div>

              <div class="form-group">
                <label for="fee_ersdel" class="col-sm-3 control-label">Эрсдлийн сан 1%</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="fee_ersdel" value="{{$order->fee_ersdel}}">
                </div>
              </div>

              <div class="form-group">
                <label for="txnvalue" class="col-sm-3 control-label">Нийт илгээх дүн</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="txnvalue" value="{{$order->txnvalue}}">
                </div>
              </div>

              <div class="form-group">
                <label for="last_name" class="col-sm-3 control-label">Хүлээн авагч овог</label>

                <div class="col-sm-9">
                  <input type="text" value="{{$order->last_name}}" readonly="true" class="form-control" id="last_name">
                </div>
              </div>
              <div class="form-group">
                <label for="first_name" class="col-sm-3 control-label">Хүлээн авагч нэр</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="first_name" value="{{$order->first_name}}">
                </div>
              </div>
              <div class="form-group">
                <label for="first_name" class="col-sm-3 control-label">Хүлээн авагч регистр</label>

                <div class="col-sm-9">
                  <input type="text" readonly="true" class="form-control" id="regnum" value="{{$order->regnum}}">
                </div>
              </div>
              <div class="form-group">
                <label for="first_name" class="col-sm-3 control-label">Хүлээн авагч данс</label>

                <div class="col-sm-9">
                  <select>
                  @foreach($order->accounts() as $account)
                    <option>{{$account->accountno}}</option>
                  @endforeach
                  </select>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="{{route('workOrders')}}" type="submit" class="btn btn-default">Буцах</a>
              <div class="pull-right">
                <button type="submit" class="btn btn-danger">Захиалгыг цуцлах</button>
                <button type="submit" class="btn btn-success">Захиалгыг баталгаажуулах</button>
              </div>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
    </div>
    @include('backend.user.confirmModal')
  </section>

</div>

@endsection
@section("javascript")
<style>
  table.work-list tr:hover td {
  background-color: #e9eaed;
  cursor:pointer;
  }
</style>
<script>
$(function(){
  $("#_work").addClass("open active");
  $("#_work_list").addClass("active");

});
</script>
@endsection
