@foreach($proposals as $p)
<div id="pid_{{$p->id}}" class="box box-widget">
  <div class="box-header with-border">
    <div class="user-block">
      <img class="img-circle img-sm" src="{{$p->user->getAvatar()}}" alt="">
    <span class="username">
    {{$p->user->first_name}} {{$p->user->last_name}}
    <span class="text-muted pull-right">{{$p->created_at}}</span>
    </span>
    <?php $rate=$p->rates ? $p->rates->rate:null;?>
    <span class="description">
      @if($rate)
      <i @if($rate >= 1)style="color:#2dc3e8" @endif class="fa fa-star fa-lg"></i>
      <i @if($rate >= 2)style="color:#2dc3e8" @endif class="fa fa-star fa-lg"></i>
      <i @if($rate >= 3)style="color:#2dc3e8" @endif class="fa fa-star fa-lg"></i>
      <i @if($rate >= 4)style="color:#2dc3e8" @endif class="fa fa-star fa-lg"></i>
      <i @if($rate >= 5)style="color:#2dc3e8" @endif class="fa fa-star fa-lg"></i>
      @else
      <i data-id="1" class="fa fa-star fa-lg "></i>
      <i data-id="2"  class="fa fa-star fa-lg "></i>
      <i data-id="3" class="fa fa-star fa-lg "></i>
      <i data-id="4" class="fa fa-star fa-lg "></i>
      <i data-id="5" class="fa fa-star fa-lg "></i>
      @endif

    </span>
  </div>
</div>
<div class="box-body">
    {{$p->proposal}}<br/><br/>
    @if($p->status === 1)
    <p><i class="fa fa-check-circle-o" style="color:green"></i> Саналыг зөвшөөрсөн</p>
    @foreach($p->txns() as $txn )
    <p><i class="fa fa-check-circle-o" @if($txn->statuscode === 1) style="color:green" @endif ></i> <span class="text-primary">Шилжүүлсэн дүн: {{number_format($txn->salary)}} ₮ </span> @if($txn->statuscode === 0) <i><small class="text-warning">/ Ажил олгогчийн гүйлгээ баталгаажаагүй байна /</small></i> @endif</p><br/>
    @endforeach
  </div>
  <div class="box-footer box-comments">
    @include('frontend.work.comment_prop')
    @elseif($p->status === 0)
    <p><i class="fa fa-check-circle-o" ></i> Санал илгээсэн</p>
    @endif
  </div>
</div>
<br/>
@endforeach
