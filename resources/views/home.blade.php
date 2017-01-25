@extends('layouts.app')

@section('content')
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">
    <div class="callout callout-info">
      <h4>Сайн байна уу !</h4>

      <p>Та EZN-н админий хуудасанд нэвтэрсэн байна.</p>
    </div>
    <!-- Default box -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$categorycount}}</h3>

              <p>Нийт мэргэжил</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/backend/category/add" class="small-box-footer">Дэлгэрэнгүй <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Нийт секци</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/backend/section/add" class="small-box-footer">Дэлгэрэнгүй <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$usercount}}</h3>

              <p>Нийт хэрэглэгч</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people-outline"></i>
            </div>
            <a href="#" class="small-box-footer">Дэлгэрэнгүй <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$ordercount}}</h3>

              <p>Ажлын захиалга</p>
            </div>
            <div class="icon">
              <i class="ion ion-card"></i>
            </div>
            <a href="/backend/order" class="small-box-footer"> Дэлгэрэнгүй <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
@endsection
