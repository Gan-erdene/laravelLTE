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
          <div class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="company_name" class="col-sm-3 control-label">Захиалагч байгууллагын нэр</label>

                <div class="col-sm-9">
                  <span>{{$order->company_name}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="work_name" class="col-sm-3 control-label">Гүйцэтгэсэн ажлын утга</label>

                <div class="col-sm-9">
                  <span>{{$order->work_name}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="created_at" class="col-sm-3 control-label">Захиалга илгээсэн огноо</label>
                <div class="col-sm-9">
                  <span>{{date('Y.m.d H:i', strtotime($order->created_at))}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="salary" class="col-sm-3 control-label">Гарт олгох цалин</label>

                <div class="col-sm-9">
                  <span>{{number_format($order->salary, 2)}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="fee_nd" class="col-sm-3 control-label">ЭМ, НДШ 10%</label>

                <div class="col-sm-9">
                  <span>{{number_format($order->fee_nd, 2)}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="fee_haoat" class="col-sm-3 control-label">ХАОАТ 10%</label>

                <div class="col-sm-9">
                  <span>{{number_format($order->fee_haoat, 2)}}</span>
                </div>
              </div>

              <div class="form-group">
                <label for="fee_ersdel" class="col-sm-3 control-label">Эрсдлийн сан 1%</label>

                <div class="col-sm-9">
                  <span>{{number_format($order->fee_ersdel, 2)}}</span>
                </div>
              </div>

              <div class="form-group">
                <label for="fee_haoat" class="col-sm-3 control-label">Үйлчилгээний шимтгэл</label>

                <div class="col-sm-9">
                  <span>{{number_format($order->fee_txn, 2)}}</span>
                </div>
              </div>

              <div class="form-group">
                <label for="txnvalue" class="col-sm-3 control-label">Илгээх дүн</label>

                <div class="col-sm-9">
                  <span>{{number_format($order->txnvalue-$order->fee_txn, 2)}}</span>
                </div>
              </div>

              <div class="form-group">
                <label for="txnvalue" class="col-sm-3 control-label">Нийт дүн</label>

                <div class="col-sm-9">
                  <span>{{number_format($order->txnvalue, 2)}}</span>
                </div>
              </div>

              <div class="form-group">
                <label for="last_name" class="col-sm-3 control-label">Хүлээн авагч овог</label>

                <div class="col-sm-9">
                  <span>{{$order->last_name}}"</span>
                </div>
              </div>
              <div class="form-group">
                <label for="first_name" class="col-sm-3 control-label">Хүлээн авагч нэр</label>

                <div class="col-sm-9">
                  <span>{{$order->first_name}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="first_name" class="col-sm-3 control-label">Хүлээн авагч регистр</label>

                <div class="col-sm-9">
                  <span>{{$order->regnum}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="first_name" class="col-sm-3 control-label">Хүлээн авагч данс</label>

                <div class="col-sm-9">
                  <select id="accounts">
                  @foreach($order->accounts() as $account)
                    <option value="{{$account->accountno}}">{{$account->accountno}}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              @if($order->statuscode === 1)
              <div class="form-group">
                <label for="accepted_at" class="col-sm-3 control-label">Баталгаажуулсан огноо</label>

                <div class="col-sm-9">
                  {{date('Y.m.d H:i', strtotime($order->getStatus()->created_at))}}
                </div>
              </div>
              @elseif($order->statuscode === 2)
              <div class="form-group">
                <label for="rejected_at" class="col-sm-3 control-label">Цуцалсан огноо</label>

                <div class="col-sm-9">
                  {{date('Y.m.d H:i', strtotime($order->getStatus()->created_at))}}
                </div>
              </div>
              @endif

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="{{route('workOrders')}}" type="submit" class="btn btn-default">Буцах</a>
              @if($order->statuscode === 0)
              <div class="pull-right">
                <button class="btn btn-danger rejectorder">Захиалгыг цуцлах</button>
                <button class="btn btn-success acceptorder">Захиалгыг баталгаажуулах</button>
              </div>
              @endif
            </div>
            <!-- /.box-footer -->
          </div>
        </div>
    </div>
    @if($order->statuscode === 0)
    @include('backend.workorder.accept', ['order'=>$order])
    @include('backend.workorder.reject', ['order'=>$order])
    @endif
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

  $(document).on("click", ".acceptorder", function () {
       var accountno = $('#accounts').val();
       $("#acceptModal #accountno").val( accountno );
       $("#acceptModal").modal("show");
  });
  $(document).on("click", ".rejectorder", function () {
       var accountno = $('#accounts').val();
       $("#rejectModal #accountno").val( accountno );
       $("#rejectModal").modal("show");
  });
});
</script>
@endsection
