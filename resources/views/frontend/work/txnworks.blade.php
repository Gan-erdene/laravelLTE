@extends('layouts.frontend')
@section('javascripts')
<style>
  table.work-list tr:hover td {
  background-color: #e9eaed;
  cursor:pointer;
  }
</style>
<script>
jQuery(document).ready(function($) {
  $(".clickable-row").click(function() {
      window.document.location = $(this).data("href");
  });
});
</script>
@endsection
@section('content')
<div class="container page-content">
  <div class="row">
<div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">Та нийт 1 ажил оруулсан байна </h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="row">
                <div class="table-responsive">
            <table class="table work-list">
              <thead>
                <tr>
                  <th nowrap rowspan="2"><span>д/д</span></th>
                  <th rowspan="2"><span>Захиалгын код</span></th>
                  <th rowspan="2"><span>Захиалагчийн нэр</span></th>
                  <th rowspan="2"><span>Гүйцэтгэх ажлын утга</span></th>
                  <td colspan="3" class="text-center"><span>Ажил гүйцэтгэгч</span></td>
                  <th rowspan="2" class="text-center"><span>Ажил эхлэх ОГНОО</span></th>
                  <th rowspan="2" class="text-center"><span>Ажил дуусах ОГНОО</span></th>
                  <th rowspan="2"><span>Дүн</span></th>
                  <th rowspan="2">Төлөв</th>
                </tr>
                <tr>
                  <th>Овог</th>
                  <th>Нэр</th>
                  <th>Регистр</th>
                </tr>
              </thead>
              <tbody>
                @foreach($list as $work)
                <tr class='clickable-row' data-href="{{route('newsfeedWork', $work->workid)}}">
                  <td>{{$loop->index+1}}</td>
                  <td>#{{$work->id}}</td>
                  <td>{{$work->company_name}}</td>
                  <td>{{$work->work_name}}</td>
                  <td>{{$work->last_name}}</td>
                  <td>{{$work->first_name}}</td>
                  <td>{{$work->regnum}}</td>
                  <td>{{$work->startdate}}</td>
                  <td>{{$work->enddate}}</td>
                  <td>{{number_format($work->txnvalue, 2)}}</td>
                  <td class="text-center">
                    @if($work->statuscode === 0)
                    <span class="label label-warning">Илгээсэн</span>
                    @elseif($work->statuscode === 1)
                    <span class="label label-success">Баталгаажсан</span>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
              </div>
              @if(sizeof($list) > 0)
              <div class="row">
                <div class="col-sm-12">
                  {!! $list->links() !!}
                </div>
              </div>
              @endif
                </div>

      </div>
    </div>
  </div>
@endsection
