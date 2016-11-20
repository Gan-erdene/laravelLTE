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
              <table class="table">
                <tr>
                  <td width="30%" class="text-right">Захиалагч байгууллагын нэр: </td>
                  <td><span>{{$order->company_name}}</span></td>
                </tr>
                <tr>
                  <td class="text-right">Гүйцэтгэсэн ажлын утга: </td>
                  <td><span>{{$order->work_name}}</span></td>
                </tr>
                <tr>
                  <td class="text-right">Захиалга илгээсэн огноо: </td>
                  <td><span>{{date('Y.m.d H:i', strtotime($order->created_at))}}</span></td>
                </tr>
                <tr class="info">
                  <td class="text-right">Гарт олгох цалин: </td>
                  <td><span>{{number_format($order->salary, 2)}}</span></td>
                </tr>
                <tr class="info">
                  <td class="text-right">ЭМ, НДШ 10%: </td>
                  <td><span>{{number_format($order->fee_nd, 2)}}</span></td>
                </tr>
                <tr class="info">
                  <td class="text-right">ХАОАТ 10%: </td>
                  <td><span>{{number_format($order->fee_haoat, 2)}}</span></td>
                </tr>
                <tr class="info">
                  <td class="text-right">Эрсдлийн сан 1%: </td>
                  <td><span>{{number_format($order->fee_ersdel, 2)}}</span></td>
                </tr>
                <tr class="info">
                  <td class="text-right">Илгээх дүн: </td>
                  <td><span>{{number_format($order->txnvalue-$order->fee_txn, 2)}}</span></td>
                </tr>
                <tr class="info">
                  <td class="text-right">Үйлчилгээний шимтгэл: </td>
                  <td><span>{{number_format($order->fee_txn, 2)}}</span></td>
                </tr>
                <tr class="info">
                  <td class="text-right">Нийт дүн: </td>
                  <td><span>{{number_format($order->txnvalue, 2)}}</span></td>
                </tr>
                <tr>
                  <td class="text-right">Хүлээн авагч овог: </td>
                  <td><span>{{$order->last_name}}"</span></td>
                </tr>
                <tr>
                  <td class="text-right">Хүлээн авагч нэр: </td>
                  <td><span>{{$order->first_name}}</span></td>
                </tr>
                <tr>
                  <td class="text-right">Хүлээн авагч нэр: </td>
                  <td><span>{{$order->first_name}}</span></td>
                </tr>
                <tr>
                  <td class="text-right">Хүлээн авагч регистр: </td>
                  <td><span>{{$order->regnum}}</span></td>
                </tr>
                  @if($order->statuscode === 1)
                <tr class="success">
                  <td class="text-right">Баталгаажуулсан огноо:</td>
                  <td>{{date('Y.m.d H:i', strtotime($order->getStatus()->created_at))}}</td>
                </tr>
                <tr class="success">
                  <td class="text-right">Баталгаажуулсан ажилтан:</td>
                  <td>{{App\sf_guard_user::find($order->getStatus()->change_user_id)->getShortName()}}</td>
                </tr>
                  @elseif($order->statuscode === 2)
                <tr class="danger">
                  <td class="text-right">Татгалзсан огноо:</td>
                  <td>{{date('Y.m.d H:i', strtotime($order->getStatus()->created_at))}}</td>
                </tr>
                <tr class="danger">
                  <td class="text-right">Татгалзсан ажилтан:</td>
                  <td>{{App\sf_guard_user::find($order->getStatus()->change_user_id)->getShortName()}}</td>
                </tr>
                @else
                <tr>
                  <td class="text-right">Хүлээн авагч данс: </td>
                  <td><select id="accounts">
                    @foreach($order->accounts() as $account)
                      <option value="{{$account->accountno}}">{{$account->accountno}}</option>
                    @endforeach
                    </select></td>
                </tr>
                  @endif
              </table>

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
