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
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      @include('status')
    <div class="row">
      <!-- left column -->

      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Захиалгын жагсаалт</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered work-list">
                <tbody><tr>
                  <th nowrap rowspan="2">Д/д</th>
                  <th rowspan="2">Код</th>
                  <th>Шилжүүлэгч</th>
                  <th colspan="3" class="text-center">Хүлээн авагч</th>
                  <th rowspan="2">Захиалагч байгууллага</th>
                  <th rowspan="2">Гүйлцэтгэсэн ажлын утга</th>
                  <th rowspan="2">Нийт дүн</th>
                  <th rowspan="2">Илгээсэн огноо</th>
                  <th rowspan="2">Төлөв</th>
                </tr>
                <tr>
                  <th>Эконетворк</th>
                  <th>Нэр</th>
                  <th>Регистр</th>
                  <th>Дансны дугаар</th>
                </tr>
                @foreach($list as $item)
                <tr class='clickable-row' data-href="{{route('viewOrder', $item->id)}}">
                  <td>{{$loop->index+1}}</td>
                  <td>{{$item->id}}</td>
                  <td>---</td>
                  <td>{{$item->first_name}}.{{substr($item->last_name, 0, 1)}}</td>
                  <td>{{$item->regnum}}</td>
                  <td>
                    <select>
                    @foreach($item->accounts() as $account)
                      <option>{{$account->accountno}}</option>
                    @endforeach
                    </select>
                  </td>
                  <td>{{$item->company_name}}</td>
                  <td>{{$item->work_name}}</td>
                  <td>{{number_format($item->txnvalue, 2)}}</td>
                  <td>{{date('Y.m.d H:i', strtotime($item->created_at))}}</td>
                  @if( $item->statuscode === 0 )
                    <td><span class="badge bg-yellow"> Баталгаажуулах </span></td>
                  @elseif( $item->statuscode == 1 )
                    <td><span class="badge bg-green"> Баталгаажсан </span></td>
                  @endif
                </tr>
                @endforeach
              </tbody></table>

            </div>

          </div>
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

  $(".clickable-row").click(function() {
      window.document.location = $(this).data("href");
  });
});
</script>
@endsection
